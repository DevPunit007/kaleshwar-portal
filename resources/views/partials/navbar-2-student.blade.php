<div class="horizontal-bar-wrap">
    <div class="header-topnav">
        <div class="container-fluid">
            <div class=" topnav rtl-ps-none" id="" data-perfect-scrollbar data-suppress-scroll-x="true">
                <ul class="menu float-left">
                    <li><div><div>
                        <a href="{{ route('booking-list-current', app()->getLocale()) }}"><i class="fad fa-ticket-alt fa-lg mx-2"></i>Bookings</a>
                        <ul>
                            <li class="nav-item">
                                <a href="{{ route('booking-list', app()->getLocale()) }}">
                                    <span class="item-name">Booking List</span>
                                </a>
                            </li>
                        </ul>
                    </div></div></li>
                    <li><a class="hover-bg-gray rounded" href="{{ route('file-list', app()->getLocale()) }}"><i class="fad fa-folder-open fa-lg mx-2"></i>Media center</a>
                </ul>
                <div style="margin: auto"></div>
                <ul class="menu pr-0">
                    <li><a class="hover-bg-gray rounded" href="{{ route('user-account', app()->getLocale()) }}"><i class="fad fa-user-edit fa-lg mx-2"></i>User Account</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
