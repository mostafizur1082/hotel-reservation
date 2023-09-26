<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function ContactUs(){

        return view('frontend.contact.contact_us');
     }// End Method

     public function StoreContactUs(Request $request){

        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Your Message Send Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

     }// End Method

     public function AdminContactMessage(){

        $contact = Contact::latest()->get();
        return view('backend.contact.contact_message',compact('contact'));

     }// End Method
}
