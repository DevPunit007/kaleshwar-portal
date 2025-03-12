@extends('templates.default')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col mr-auto">
                    <h5 class="backend-title mt-2">List of active users</h5>
                </div>
                <div class="col-auto text-right d-print-none">
                    @include('pages.user.list-buttons')
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="user-list-table" class="display">
                    <thead>
                    <tr>
                        <th class="table-icon"></th>
                        <th data-priority="1">Name</th>
                        <th>Email</th>
                        <th data-priority="2">Country</th>
                        <th>Role</th>
                        <th>Last login</th>
                        <th class="d-none"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="nowrap table-icon">
                                <i class="fas fa-chevron-circle-down fa-lg mx-1 color-green op-7"></i>
                                <a href="{{ route('user-edit-basic', ['language' => app()->getLocale(), 'id' => $user->id]) }}"><i class="fas fa-chevron-circle-right fa-lg mx-1 color-theme-dark op-7"></i></a></td>
                            <td>{{$user->first_name ??''}} {{$user->last_name ??''}} {{$user->nickname ? '('.$user->nickname.')' : ''}}</td>
                            <td><a href="https://webmail.your-server.de/imp/dynamic.php?page=compose&type=new&to={{$user->email}}" target="_blank">{{$user->email}}</a></td>
                            <td>@if($user->contactInformation){{ __('countries.'.$user->contactInformation->country)}}@endif</td>
                            <td>{{$user->userRule->name ??''}}</td>
                            <td data-order="{{$user->last_login ??''}}">{{$user->last_login ? date_format(date_create($user->last_login), 'd.m.Y') : ''}}</td>
                            <td class="d-none">
                                @if($user->contactInformation)
                                <table class="table-in-row nowrap w-100">
                                    <tr>
                                        <td class="mx-4 text-muted text-small">Full name:</td>
                                        <td class="mx-4">{{$user->first_name ??''}} {{$user->middle_name ? $user->middle_name : ''}} {{$user->last_name ??''}} {{$user->nickname ? '('.$user->nickname.')' : ''}}</td>
                                        <td class="mx-4 text-muted text-small">Gender:</td>
                                        <td class="mx-4">@if($user->personalInformation && $user->personalInformation->gender) @switch($user->personalInformation->gender) @case(1) Male @break @case(2) Female @break @endswitch @else ./. @endif</td>
                                        <td class="mx-4 text-muted text-small">Married:</td>
                                        <td class="mx-4">@if($user->personalInformation && $user->personalInformation->married) @switch($user->personalInformation->married) @case(1) Yes @break @case(2) No @break @endswitch @else ./. @endif</td>
                                        <td class="mx-4 text-muted text-small">Bookings:</td>
                                        <td class="mx-4">{{$user->bookings_count ? $user->bookings_count : './.'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="mx-4 text-muted text-small">Street:</td>
                                        <td class="mx-4">{{$user->contactInformation->address_street ??''}} {{$user->contactInformation->address_no ??''}}</td>

                                        <td class="mx-4 text-muted text-small">Birth Date:</td>
                                        <td class="mx-4">@if($user->personalInformation && $user->personalInformation->date_of_birth) {{ date_format(date_create($user->personalInformation->date_of_birth), 'd.m.Y') }} @else ./. @endif</td>
                                        <td class="mx-4 text-muted text-small">Name of Spouse:</td>
                                        <td class="mx-4">@if($user->personalInformation && $user->personalInformation->name_of_spouse) {{$user->personalInformation->name_of_spouse}} @else ./. @endif</td>
                                        <td class="mx-4 text-muted text-small">Groups:</td>
                                        <td class="mx-4">{{$user->groups_count ? $user->groups_count : './.'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="mx-4 text-muted text-small">City, Country:</td>
                                        <td class="mx-4">{{$user->contactInformation->zip ??''}} {{$user->contactInformation->city ??''}}, {{$user->contactInformation->country ??''}}</td>
                                        <td class="mx-4 text-muted text-small">Ashram Status:</td>
                                        <td class="mx-4">{{$user->ashramData && $user->ashramData->user_status ? $user->ashramData->user_status : './.'}}</td>
                                        <td class="mx-4 text-muted text-small">Profession:</td>
                                        <td class="mx-4">{{$user->personalInformation && $user->personalInformation->profession ? $user->personalInformation->profession : './.'}}</td>
                                        <td class="mx-4 text-muted text-small">Files:</td>
                                        <td class="mx-4">./.</td>
                                    </tr>
                                </table>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('partials.modal_user_search')

@endsection
