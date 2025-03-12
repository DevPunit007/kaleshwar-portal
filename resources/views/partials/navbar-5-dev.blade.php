<div class="horizontal-bar-wrap">
    <div class="header-topnav">
        <div class="container-fluid">
            <div class=" topnav rtl-ps-none" id="" data-perfect-scrollbar data-suppress-scroll-x="true">
                    <ul class="menu float-left">
                    
                    <li><div><div>
                        <a href="{{ route('location-list', app()->getLocale()) }}"><i class="fad fa-map fa-lg mx-2"></i>Locations</a>
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

                    <li><div><div>
                        <a href="{{ route('event-list', app()->getLocale()) }}"><i class="fad fa-calendar-star fa-lg mx-2"></i>Events</a>
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

                        </ul>
                    </div></div></li>
                
                    <li><div><div>
                        <a href="{{ route('timeline-media-list', app()->getLocale()) }}"><i class="fad fa-photo-video fa-lg mx-2"></i>Timeline</a>
                        <ul>
                            <li class="nav-item">
                                <a href="{{ route('timeline-media-list', app()->getLocale()) }}">
                                    <span class="item-name">Timeline Media List</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('timeline-media-add', app()->getLocale()) }}">

                                    <span class="item-name">Add Media Content</span>
                                </a>
                            </li>
                        </ul>
                    </div></div></li>
                    
                </ul>
                <div style="margin: auto"></div>
                <ul class="menu pr-0">
                    <li><a class="hover-bg-gray rounded" href="{{ route('user-account', app()->getLocale()) }}"><i class="fad fa-user-edit fa-lg mx-2"></i>User Account</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
