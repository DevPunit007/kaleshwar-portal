@extends('templates.default')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col mr-auto">
                    <h5 class="backend-title mt-2">
                        @if($list_status == 'current')
                            List of payments of the last 30 days
                        @else
                            List of all payments
                        @endif
                    </h5>
                </div>
                <div class="col-auto text-right d-print-none">
                    <button type="button" class="btn btn-outline-primary btn-header dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        List types
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('payment-list-current', app()->getLocale()) }}">Current payments</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('payment-list', app()->getLocale()) }}">All payments</a>
                    </div>

                    <button onclick="print();" type="button" class="btn btn-outline-info btn-header">Print</button>
                    <button onclick="alert('is coming soon');" type="button" class="btn btn-outline-success btn-header">Add New Payment</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive d-print-table">
                <table id="booking-list-table" class="display">
                    <thead>
                        <tr>
                            <th class="table-icon d-print-none"></th>
                            <th>Payment at</th>
                            <th>Payer</th>
                            <th class="select-filter-row">Reference</th>
                            <th>Amount</th>
                            <th class="d-print-none"></th>
                            <th class="select-filter-row">Bank</th>
                            <th class="d-none"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td class="nowrap d-print-none">
                                <i class="fas fa-chevron-circle-down fa-lg mx-1 color-green op-7"></i>
                                <a href="{{ route('booking-edit', ['language' => app()->getLocale(), 'id' => $booking->id]) }}"><i class="fas fa-chevron-circle-right fa-lg mx-1 color-theme-dark op-7"></i></a></td>
                            <td data-order="{{date_format(date_create($booking->created_at), 'Y-m-d H:i')}}">{{date_format(date_create($booking->created_at), 'd.m.Y H:i')}}</td>
                            <td><span class="text-nowrap"><a href="{{ route('user-edit-basic', ['language' => app()->getLocale(), 'id' => $booking->user->id]) }}">{{$booking->user->first_name}} {{$booking->user->last_name}}</a><a href="https://webmail.your-server.de/imp/dynamic.php?page=compose&type=new&to={{$booking->user->email}}" target="_blank">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                                    </svg></a></span><br>@if($booking->user->contactInformation){{__('countries.'.$booking->user->contactInformation->country)}}@endif @if($booking->user->ashramData && $booking->user->ashramData->attend_ie2011 == 1) - IE @endif</td>
                            <td>{{$booking->event->list_name}}</td>
                            <td>{{$booking->eventSectionDetailLanguage->title_short ??'(missing translation)'}}</td>
                            <td>{{$booking->event_section_price ??''}} @switch($booking->currency) @case('1') $ @break @case('2') € @break @default ./. @break @endswitch</td>
                            <td class="d-print-none @if($booking->eventSection->has_registration == 1 && empty($booking->bookingDetail)) bg-warning @endif" title="{{$booking->booking_message ??''}}">@if($booking->booking_message)<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                    <circle cx="8" cy="4.5" r="1"/>
                                </svg>@endif</td>
                            <td class="d-none">
                                <table class="table-in-row">
                                    <tr>
                                        <td class="mx-4">
                                            <p class="m-0">Ticket Number:</p>
                                        </td>
                                        <td class="mx-4">
                                            <p class="m-0">{{$booking->id ??''}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                       <td class="mx-4">
                                            <p class="m-0">User message:</p>
                                        </td>
                                        <td class="mx-4">
                                            <p class="m-0">{{$booking->booking_message ??''}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="mx-4">
                                            <p class="m-0">Internal note:</p>
                                        </td>
                                        <td class="mx-4">
                                            <p class="m-0">{{$booking->notes ??''}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="{{ route('booking-email', ['language' => app()->getLocale(), 'id' => $booking->id]) }}">
                                                Preview Booking Email
                                            </a>
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                            </td>
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
                            <th class="d-none"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="text-center">
                @if($list_status == 'current')
                    The  booking list contains all current events with event start after {{\Carbon\Carbon::today()->subMonth(2)->format('d.m.Y')}}
                @elseif($list_status == 'open')
                    The booking list contains all bookings with open status ("Registered", "Accepted" and "Wait")
                @else
                    The booking list contains all bookings since portal was launched in August 2020.
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
