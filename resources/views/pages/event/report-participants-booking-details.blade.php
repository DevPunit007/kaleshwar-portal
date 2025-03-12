@extends('templates.default')

@section('content')
<div class="container">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card rounded mb-5">
                <div class="card-header">
                    <div class="row">
                        <div class="col mr-auto">
                            <h5 class="backend-title mt-2">Participants with Booking details for {{$event->eventDetails[0]->title}}</h5>
                        </div>
                        <div class="col-auto text-right d-print-none">
                            <button onclick="print();" type="button" class="btn btn-outline-info btn-header">Print</button>
                            <button onclick="window.location.href = '{{ route('event-edit', ['language' => app()->getLocale(), 'id' => $event->id]) }}';" type="button" class="btn btn-outline-dark btn-header">Back</button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive d-print-table">
                        <table id="booking-list-table" class="display">
                            <thead>
                            <tr>
                                <th class="table-icon d-print-none"></th>
                                <th>Booking at</th>
                                <th>Participant</th>
                                <th class="select-filter-row">Section</th>
                                <th>Arrival Ashram</th>
                                <th>Departure Ashram</th>
                                <th>Transportation</th>
                                <th>Roomate</th>
                                <th>Ticket</th>
                                <th class="select-filter-row">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td class="nowrap d-print-none">
                                        <a href="{{ route('booking-edit', ['language' => app()->getLocale(), 'id' => $booking->id]) }}"><i class="fas fa-chevron-circle-right fa-lg mx-1 color-theme-dark op-7"></i></a></td>
                                    <td data-order="{{$booking->created_at ??''}}">{{date_format(date_create($booking->created_at), 'd.m.Y')}}</td>
                                    <td class="dt-body-nowrap"><a href="{{ route('user-edit-basic', ['language' => app()->getLocale(), 'id' => $booking->user->id]) }}">{{$booking->user->first_name}} {{$booking->user->last_name}}</a><a href="https://webmail.your-server.de/imp/dynamic.php?page=compose&type=new&to={{$booking->user->email}}" target="_blank">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                                            </svg></a><br>@if($booking->user->contactInformation) {{__('countries.'.$booking->user->contactInformation->country)}} @endif</td>
                                    <td>{{$booking->eventSectionDetail->TitleShort ??''}}</td>
                                    @if($booking->bookingDetail)<td data-order="{{date_format(date_create($booking->bookingDetail->arrival_ashram), 'Y-m-d')}}">{{date_format(date_create($booking->bookingDetail->arrival_ashram), 'd.m.Y')}}</td>@else <td></td>@endif
                                    @if($booking->bookingDetail)<td data-order="{{date_format(date_create($booking->bookingDetail->departure_ashram), 'Y-m-d')}}">{{date_format(date_create($booking->bookingDetail->departure_ashram), 'd.m.Y')}}</td>@else <td></td>@endif
                                    <td>{{$booking->bookingDetail->transportation ??''}}</td>
                                    <td>{{$booking->bookingDetail->roommate_preference ??''}}</td>


                                    <td>{{$booking->id ??''}}</td>
                                    <td class="{{$booking->BookingStatusColor ??''}}">{{$booking->BookingStatusName ??''}}</td>
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
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <pre>{{print_r($booking)}}</pre>--}}
</div>
@endsection
