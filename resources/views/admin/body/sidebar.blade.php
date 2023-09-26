<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend') }}/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Rocker</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
     </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        @if(Auth::user()->can('team.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Teams </div>
            </a>
            <ul>
                @if(Auth::user()->can('all.team'))
                <li> <a href="{{ route('all.team') }}"><i class='bx bx-radio-circle'></i>All Team</a>
                </li>
                @endif
                @if(Auth::user()->can('add.team'))
                <li> <a href="{{ route('add.team') }}"><i class='bx bx-radio-circle'></i>Add Team</a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(Auth::user()->can('bookingarea.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Book Area </div>
            </a>
            <ul>
                @if(Auth::user()->can('update.bookingarea'))
                <li> <a href="{{ route('book.area') }}"><i class='bx bx-radio-circle'></i>Update BookArea </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(Auth::user()->can('room.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Room Type </div>
            </a>
            <ul>
                @if(Auth::user()->can('all.room'))
                <li> <a href="{{ route('room.type.list') }}"><i class='bx bx-radio-circle'></i>Room Type List </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        <li class="menu-label">Booking Manage</li>

        @if(Auth::user()->can('booking.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Booking </div>
            </a>
            <ul>
                @if(Auth::user()->can('all.booking'))
                <li> <a href="{{ route('booking.list') }}"><i class='bx bx-radio-circle'></i>Booking List</a>
                </li>
                @endif
                @if(Auth::user()->can('add.booking'))
                <li> <a href="{{ route('add.room.booking') }}"><i class='bx bx-radio-circle'></i> Add Booking </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(Auth::user()->can('roomlist.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage RoomList </div>
            </a>
            <ul>
                @if(Auth::user()->can('all.roomlist'))
                <li> <a href="{{ route('view.room.list') }}"><i class='bx bx-radio-circle'></i>Room List</a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(Auth::user()->can('setting.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Setting</div>
            </a>
            <ul>
                @if(Auth::user()->can('smtp.setting'))
                <li> <a href="{{ route('smtp.setting') }}"><i class='bx bx-radio-circle'></i>SMTP Setting</a>
                </li>
                @endif
                @if(Auth::user()->can('site.setting'))
                <li> <a href="{{ route('site.setting') }}"><i class='bx bx-radio-circle'></i>Site Setting</a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(Auth::user()->can('testimonial.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Tesimonial</div>
            </a>
            <ul>
                @if(Auth::user()->can('all.testimonial'))
                <li> <a href="{{ route('all.testimonial') }}"><i class='bx bx-radio-circle'></i>All Testimonial</a>
                </li>
                @endif
                @if(Auth::user()->can('add.testimonial'))
                <li> <a href="{{ route('add.testimonial') }}"><i class='bx bx-radio-circle'></i>Add Testimonial</a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(Auth::user()->can('blog.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Blog</div>
            </a>
            <ul>
                @if(Auth::user()->can('blog.category'))
                <li> <a href="{{ route('blog.category') }}"><i class='bx bx-radio-circle'></i>Blog Category </a>
                </li>
                @endif
                @if(Auth::user()->can('all.blog'))
                <li> <a href="{{ route('all.blog.post') }}"><i class='bx bx-radio-circle'></i>All Blog Post</a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(Auth::user()->can('comment.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Comment</div>
            </a>
            <ul>
                @if(Auth::user()->can('all.comment'))
                <li> <a href="{{ route('all.comment') }}"><i class='bx bx-radio-circle'></i>All Comments </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(Auth::user()->can('bookingreport.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Booking Report </div>
            </a>
            <ul>
                @if(Auth::user()->can('search.bookingreport'))
                <li> <a href="{{ route('booking.report') }}"><i class='bx bx-radio-circle'></i>Booking Report </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(Auth::user()->can('gallery.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Hotel Gallery </div>
            </a>
            <ul>
                @if(Auth::user()->can('all.gallery'))
                <li> <a href="{{ route('all.gallery') }}"><i class='bx bx-radio-circle'></i>All Gallery </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(Auth::user()->can('contact.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Contact Message </div>
            </a>
            <ul>
                @if(Auth::user()->can('all.contact'))
                <li> <a href="{{ route('contact.message') }}"><i class='bx bx-radio-circle'></i>Contact Message </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        <li class="menu-label">Role & Permission </li>

        @if(Auth::user()->can('role&permission.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Role & Permission </div>
            </a>
            <ul>
                @if(Auth::user()->can('all.permission'))
                <li> <a href="{{ route('all.permission') }}"><i class='bx bx-radio-circle'></i>All Permission </a>
                </li>
                @endif
                @if(Auth::user()->can('all.role'))
                <li> <a href="{{ route('all.roles') }}"><i class='bx bx-radio-circle'></i>All Roles </a>
                </li>
                @endif
                @if(Auth::user()->can('add.role.permission'))
                <li> <a href="{{ route('add.roles.permission') }}"><i class='bx bx-radio-circle'></i>Role In Permission </a>
                </li>
                @endif
                @if(Auth::user()->can('all.role.permission'))
                <li> <a href="{{ route('all.roles.permission') }}"><i class='bx bx-radio-circle'></i>All Role In Permission </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(Auth::user()->can('manageadmin.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Admin User </div>
            </a>
            <ul>
                @if(Auth::user()->can('all.admin'))
                <li> <a href="{{ route('all.admin') }}"><i class='bx bx-radio-circle'></i>All Admin </a>
                </li>
                @endif
                @if(Auth::user()->can('add.admin'))
                <li> <a href="{{ route('add.admin') }}"><i class='bx bx-radio-circle'></i>Add Admin </a>
                </li>
                @endif
            </ul>
        </li>
@endif

    </ul>
    <!--end navigation-->
</div>
