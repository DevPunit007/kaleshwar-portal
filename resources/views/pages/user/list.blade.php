@extends('templates.default')

@section('content')
@php //dd($user); @endphp
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col mr-auto">
                    <h5 class="backend-title mt-2">@isset($keyword) List of users with keyord "{{$keyword}}" @else List of all users @endisset</h5>
                </div>
                <div class="col-auto text-right d-print-none">
                    @include('pages.user.list-buttons')
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="select-list-table" class="display">
                    <thead>
                        <tr>
                            <th style="width: 20px;"></th>
                            <th data-priority="1">Name</th>
                            <th>Email</th>
                            <th>City</th>
                            <th data-priority="2">Country</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Account</th>
                            <th>Groups</th>
                            <th>Bookings</th>
<!--                            <th>Last event</th>-->
                            <th>Last login</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr @if($user->status == '3') class="status_blocked" @endif>
                            <td class="nowrap">
                                <a href="{{ route('user-edit-basic', ['language' => app()->getLocale(), 'id' => $user->id]) }}"><i class="fas fa-chevron-circle-right fa-lg mx-1 color-theme-dark op-7"></i></a></td>
                            <td>{{$user->first_name ??''}} {{$user->last_name ??''}} {{$user->nickname ? '('.$user->nickname.')' : ''}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->contactInformation->city ??''}}</td>
                            <td>@if($user->contactInformation){{ __('countries.'.$user->contactInformation->country)}}@endif</td>
                            <td>{{$user->userRule->name ??''}}</td>
                            <td>{{$user->ashramData->user_status ??''}}</td>
                            <td>@switch($user->status) @case(1)Active @break @case(2)Inactive @break @case(3)Blocked @break @endswitch</td>
                            <td class="dt-center">{{$user->groups_count ??''}}</td>
                            <td class="dt-center">{{$user->bookings_count ??''}}</td>
                            {{--@php if(isset($user->bookings[0])) { $last_event = $user->bookings->sortBy('event_start_date')->last()->event_start_date; } else {$last_event = null;} @endphp
                            <td data-order="{{$last_event ??''}}">{{$last_event ? date_format(date_create($last_event), 'd.m.Y') : ''}}</td>--}}
                            <td data-order="{{$user->last_login ??''}}">{{$user->last_login ? date_format(date_create($user->last_login), 'd.m.Y') : ''}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@include('partials.modal_user_search')

@endsection
