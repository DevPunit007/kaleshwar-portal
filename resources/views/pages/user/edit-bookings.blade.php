@extends('pages.user.edit--frame')

@section('user-account')

<div class="col-md-9 p-0">
    <div class="user-account-section p-0">
        <div class="button-bar">
            <button type="button" data-toggle="collapse" data-target="#card_new_phone" aria-expanded="false" aria-controls="card_new_phone" class="btn btn-outline-success btn-header">New booking</button>
        </div>
        <div class="col-12 collapse bg-light border-bottom p-0" id="card_new_phone">
            <div class="card-body pb-0">
                <form class="new-booking-form" method="post" action="{{ route('add-booking-admin', app()->getLocale()) }}" enctype="multipart/form-data">@csrf

                    <div class="form-row">
                        <div class="form-group col-10">
                            <label for="event_section_id">Event Sections *</label>
                            <select required name="event_section_id" id="event_section_id" class="form-control bg-white">
                                <option value="" selected>Please select</option>
                                @foreach($eventSections as $eventSection)
                                    <option value="{{$eventSection->id}}">{{date_format(date_create($eventSection->event->end_date), 'Y')}} | {{$eventSection->event->eventDetails[0]->title}} ({{$eventSection->eventSectionDetails[0]->title ??''}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label for="currency">Currency *</label>
                            <select required name="currency" id="currency" class="form-control bg-white">
                                <option value="" selected></option>
                                <option value="1">USD</option>
                                <option value="2">EUR</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="booking_message">Booking message</label>
                            <textarea id="booking_message" name="booking_message" rows="2" class="form-control bg-white"></textarea>
                        </div>
                    </div>
                    <div class="form-row pb-0 mt-2">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                            <button type="submit" class="btn btn-primary submit-button btn-header">Save</button>
                            <button type="button" id="close-phone-section" data-target="#card_new_phone" class="btn btn-dark btn-header ml-2">Close</button>
                        </div>
                        <div class="form-group">
                            <label class="color-gray">* These fields are required</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="booking-list-table" class="display">
                    <thead>
                    <tr>
                        <th>Ticket</th>
                        <th>Booking at</th>
                        <th>Program</th>
                        <th>Price</th>
                        <th>Start Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>@if($booking->id > 40000) <a href="{{ route('booking-edit', ['language' => app()->getLocale(), 'id' => $booking->id]) }}"> {{$booking->id}} </a> @else <a onclick="return confirm('Do you sure you want delete that booking?');" href="{{ route('delete-booking-admin', ['language' => app()->getLocale(), 'id' => $booking->id]) }}"><i class="fad fa-eraser"></i></a> @endif </td>
                            <td data-order="{{$booking->created_at ??''}}">{{$booking->created_at ? date_format(date_create($booking->created_at), 'd.m.Y') : ''}}</td>
                            <td><a href="{{ $booking->event ? route('event-edit', ['language' => app()->getLocale(), 'id' => $booking->event->id]) : ''}}">{{$booking->event->eventDetails[0]->title ??''}}</a></td>
                            <td>@switch($booking->currency)
                                    @case('1') {{$booking->eventSection->price_usd ??''}} $ @break
                                    @case('2') {{$booking->eventSection->price_euro}} € @break
                                    @default ./. @break
                                @endswitch
                            </td>
                            <td data-order="@if($booking->event->start_date){{$booking->event->start_date ??''}} @elseif($booking->event->end_date){{$booking->event->end_date ??''}} @endif">@if($booking->event->start_date) {{ date_format(date_create($booking->event->start_date), "d.m.Y") }} @elseif($booking->event->end_date) {{ date_format(date_create($booking->event->start_date), "d.m.Y") }} @endif</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
