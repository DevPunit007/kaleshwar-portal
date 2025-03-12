<div class="horizontal-bar-wrap d-print-none">
    <div class="header-topnav">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-light bg-white">
                <ul class="navbar-nav">

                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('user-list-active', app()->getLocale()) }}"><i class="fad fa-users fa-lg mx-2"></i>Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('organizer-list', [app()->getLocale(), 'teacher']) }}"><i class="fad fa-chalkboard-teacher fa-lg mx-2"></i>{{ trans_choice('app.teacher', 2) }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('organizer-list', [app()->getLocale(), 'group']) }}"><i class="fad fa-users-class fa-lg mx-2"></i>Groups</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('location-list', app()->getLocale()) }}"><i class="fad fa-map fa-lg mx-2"></i>Locations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('event-list', app()->getLocale()) }}"><i class="fad fa-calendar-star fa-lg mx-2"></i>Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('booking-list-current', app()->getLocale()) }}"><i class="fad fa-ticket-alt fa-lg mx-2"></i>Bookings</a>
                    </li>
                </ul>
            </nav>


            {{--<div class=" topnav rtl-ps-none" id="" data-perfect-scrollbar data-suppress-scroll-x="true">
                    <ul class="menu float-left">
                    <li class="menu-title"><div><div><a href="{{ route('user-list-active', app()->getLocale()) }}">
                                    <i class="fad fa-users fa-lg mx-2"></i>Users</a>
                        <ul>
                            <li class="nav-item">
                                <a href="{{ route('user-list-active', app()->getLocale()) }}">
                                    <span class="item-name">Active user list</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user-list', app()->getLocale()) }}">
                                    <span class="item-name">All user list</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user-add', app()->getLocale()) }}">
                                    <span class="item-name">Add User</span>
                                </a>
                            </li>
                        </ul>
                    </div></div></li>

                    <li class="menu-title"><div><div>
                        <i class="fad fa-chalkboard-teacher fa-lg mx-2"></i>Teachers
                        <ul>
                            <li class="nav-item">
                                <a href="{{ route('teacher-list', app()->getLocale()) }}">
                                    <span class="item-name">Teacher List</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('organizer-add', ['language' => app()->getLocale(), 'type' => 'teacher']) }}">
                                    <span class="item-name">Add Teacher</span>
                                </a>
                            </li>
                        </ul>
                    </div></div></li>

                    <li class="menu-title"><div><div>
                        <i class="fad fa-users-class fa-lg mx-2"></i>Groups
                        <ul>
                            <li class="nav-item">
                                <a href="{{ route('group-list', app()->getLocale()) }}">
                                    <span class="item-name">Group List</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('organizer-add', ['language' => app()->getLocale(), 'type' => 'group']) }}">
                                    <span class="item-name">Add Group</span>
                                </a>
                            </li>
                        </ul>
                    </div></div></li>

                    <li class="menu-title"><div><div>
                        <i class="fad fa-map fa-lg mx-2"></i>Locations
                        <ul>
                            <li class="nav-item">
                                <a href="{{ route('location-list', app()->getLocale()) }}">
                                    <span class="item-name">Location List</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('location-add', app()->getLocale()) }}">
                                    <span class="item-name">Add Location</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('room-list', app()->getLocale()) }}">
                                    <span class="item-name">Room List</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('room-add', app()->getLocale()) }}">
                                    <span class="item-name">Add Room</span>
                                </a>
                            </li>
                        </ul>
                    </div></div></li>

                    <li class="menu-title"><div><div>
                        <i class="fad fa-calendar-star fa-lg mx-2"></i>Events
                        <ul>
                            <li class="nav-item">
                                <a href="{{ route('event-list', app()->getLocale()) }}">
                                    <span class="item-name">Event List</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('event-add', app()->getLocale()) }}">

                                    <span class="item-name">Add Event</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#">
                                    <span class="item-name">Event Categories</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('iframe-show-events', app()->getLocale()) }}">
                                    <span class="item-name">Event Preview</span>
                                </a>
                            </li>

                        </ul>
                    </div></div></li>

                    <li class="menu-title"><div><div>
                        <i class="fad fa-ticket-alt fa-lg mx-2"></i>Bookings
                        <ul>
                            <li class="nav-item">
                                <a href="{{ route('booking-list', app()->getLocale()) }}">
                                    <span class="item-name">Booking List</span>
                                </a>
                            </li>
                        </ul>
                    </div></div></li>

                </ul>
            </div>--}}
        </div>
    </div>
</div>
