<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\BookArea;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Room;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\RoomBookedDate;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Stripe;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Notifications\BookingComplete;
use Illuminate\Support\Facades\Notification;

class BookingController extends Controller
{
    public function Checkout(){

        if (Session::has('book_date')) {
            $book_data = Session::get('book_date');
            $room = Room::find($book_data['room_id']);
            $toDate = Carbon::parse($book_data['check_in']);
            $fromDate = Carbon::parse($book_data['check_out']);
            $nights = $toDate->diffInDays($fromDate);

            return view('frontend.checkout.checkout',compact('book_data','room','nights'));
         }else{

             $notification = array(
                 'message' => 'Something want to wrong!',
                 'alert-type' => 'error'
             );
             return redirect('/')->with($notification);
         } // end else

    }// End Method

    public function BookingStore(Request $request){

        $validateData = $request->validate([
            'check_in' => 'required',
            'check_out' => 'required',
            'persion' => 'required',
            'number_of_rooms' => 'required',

        ]);

        if ($request->available_room < $request->number_of_rooms) {

            $notification = array(
                'message' => 'Something want to wrong!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        Session::forget('book_date');

        $data = array();
        $data['number_of_rooms'] = $request->number_of_rooms;
        $data['available_room'] = $request->available_room;
        $data['persion'] = $request->persion;
        $data['check_in'] = date('Y-m-d',strtotime($request->check_in));
        $data['check_out'] = date('Y-m-d',strtotime($request->check_out));
        $data['room_id'] = $request->room_id;

        Session::put('book_date',$data);

        return redirect()->route('checkout');

    }// End Method

    public function CheckoutStore(Request $request){

        $user = User::where('role','admin')->get();

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'payment_method' => 'required',
        ]);

           $book_data = Session::get('book_date');
           $toDate = Carbon::parse($book_data['check_in']);
           $fromDate = Carbon::parse($book_data['check_out']);
           $total_nights = $toDate->diffInDays($fromDate);

           $room = Room::find($book_data['room_id']);
           $subtotal = $room->price * $total_nights * $book_data['number_of_rooms'] ;
           $discount = ($room->discount/100)*$subtotal;
           $total_price = $subtotal-$discount;
           $code = rand(000000000,999999999);



           if ($request->payment_method == 'Stripe') {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $s_pay = Stripe\Charge::create ([
                "amount" => $total_price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment For Booking. Booking No ".$code,

            ]);

            if ($s_pay['status'] == 'succeeded') {
                $payment_status = 1;
                $transation_id = $s_pay->id;
            }else{

                $notification = array(
                    'message' => 'Sorry Payment Field',
                    'alert-type' => 'error'
                );
                return redirect('/')->with($notification);

            }

         } else{
            $payment_status = 0;
            $transation_id = '';
         }


           $data = new Booking();
           $data->rooms_id = $room->id;
           $data->user_id = Auth::user()->id;
           $data->check_in = date('Y-m-d',strtotime($book_data['check_in']));
           $data->check_out = date('Y-m-d',strtotime($book_data['check_out']));
           $data->persion = $book_data['persion'];
           $data->number_of_rooms = $book_data['number_of_rooms'];
           $data->total_night = $total_nights;
           $data->actual_price = $room->price;
           $data->subtotal = $subtotal;
           $data->discount = $discount;
           $data->total_price = $total_price;
           $data->payment_method = $request->payment_method;
           $data->transation_id = '';
           $data->payment_status = 0;
           $data->name = $request->name;
           $data->email = $request->email;
           $data->phone = $request->phone;
           $data->country = $request->country;
           $data->state = $request->state;
           $data->zip_code = $request->zip_code;
           $data->address = $request->address;
           $data->code = $code;
           $data->status = 0;
           $data->created_at = Carbon::now();
           $data->save();

           $sdate = date('Y-m-d',strtotime($book_data['check_in']));
           $edate = date('Y-m-d',strtotime($book_data['check_out']));
           $eldate = Carbon::create($edate)->subDay();
           $d_period = CarbonPeriod::create($sdate,$eldate);
           foreach ($d_period as $period) {
               $booked_dates = new RoomBookedDate();
               $booked_dates->booking_id = $data->id;
               $booked_dates->room_id = $room->id;
               $booked_dates->book_date = date('Y-m-d', strtotime($period));
               $booked_dates->save();
           }

           Session::forget('book_date');

           $notification = array(
            'message' => 'Booking Added Successfully',
            'alert-type' => 'success'
        );
        Notification::send($user, new BookingComplete($request->name));
        return redirect('/')->with($notification);

    }// End Method

    public function UserBooking(){
        $id = Auth::user()->id;
        $allData = Booking::where('user_id',$id)->orderBy('id','desc')->get();
        return view('frontend.dashboard.user_booking',compact('allData'));

     }// End Method

     public function UserInvoice($id){

        $editData = Booking::with('room')->find($id);
        $pdf = Pdf::loadView('backend.booking.booking_invoice',compact('editData'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

     }// End Method

     public function MarkAsRead(Request $request , $notificationId){

        $user = Auth::user();
        $notification = $user->notifications()->where('id',$notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }

  return response()->json(['count' => $user->unreadNotifications()->count()]);

     }// End Method


}
