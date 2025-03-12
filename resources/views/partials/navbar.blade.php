
<div class="main-header mb-5">
    <div class="logo"><a href="https://srikaleshwar.world"><img src="{{asset('images/ashram-logo.png')}}?kaleshwarV1" alt="" style="border-radius: 50px;"></a></div>
    <div class="menu-toggle mr-auto"><div></div><div></div><div></div></div>
    <div class="d-flex align-items-center">
        <div class="horizontal-bar-wrap d-print-none">
        <div class="header-topnav">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md navbar-light">
                    <ul class="navbar-nav">
                        @if (auth()->user()->rule_id < 4)
                            {{-- MENU FOR VISITOR, STUDENT AND TEACHER--}}
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('user-account-iframe', app()->getLocale()) }}">
                                    <i class="fad fa-user-edit fa-lg mx-2"></i>User account
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('booking-user-list', app()->getLocale()) }}">
                                    <i class="fad fa-ticket-alt fa-lg mx-2"></i>Bookings
                                </a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('file-list', app()->getLocale()) }}">--}}
{{--                                    <i class="fad fa-folder-open fa-lg mx-2"></i>Media center--}}
{{--                                </a>--}}
{{--                            </li>--}}
                        @endif
                        @if (auth()->user()->rule_id == 3)
                            {{--  ONLY TEACHER --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('organizer-list', [app()->getLocale(), 'teacher']) }}">
                                    <i class="fad fa-chalkboard-teacher fa-lg mx-2"></i>{{ trans_choice('app.teacher', 2) }}
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->rule_id >= 4)
                            {{--  ONLY ADMIN AND DEV --}}
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('user-list-active', app()->getLocale()) }}">
                                    <i class="fad fa-users fa-lg mx-2"></i>Users
                                </a>
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
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fad fa-money-check-edit-alt fa-lg mx-2"></i>Payments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="modal" data-target="#appMenu"><i class="fad fa-rocket fa-lg mx-2"></i>Apps</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    </div>




    <div class="header-part-right">
        <div class="dropdown language-switch">
            <a class="btn text-muted dropdown-toggle mr-3" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fad fa-language fa-lg mx-2"></i>{{ __('app.language') }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/en/">{{ __('app.english') }}</a>
                <a class="dropdown-item" href="/de/">{{ __('app.german') }}</a>
            </div>
        </div>
        {{-- User avatar dropdown --}}
        <div class="dropdown">
            <div  class="user col align-self-end">
                {{--  Profile image  --}}
                @isset($globalData->profile_image)
                    <img src="{{url('storage/' . $globalData->profile_image->path)}}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @else
                    <i class="fad fa-user-cog fa-2x" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                @endisset
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item disabled text-black-50">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</a>
                    <div class="dropdown-divider"></div>
                    @if (auth()->user()['rule_id'] >= 4)
                        <a class="dropdown-item" href="{{ route('user-account-iframe', app()->getLocale()) }}">{{ __('navbar.user-account')}}</a>
                        <a class="dropdown-item" href="{{ route('booking-user-list', app()->getLocale()) }}">Bookings</a>
                    @endif
                    <a class="dropdown-item" href="#" onclick="alert('is coming soon');">{{ __('navbar.settings') }}</a>
                    <a class="dropdown-item" href="{{ route('logout', app()->getLocale()) }}">{{ __('navbar.logout') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

