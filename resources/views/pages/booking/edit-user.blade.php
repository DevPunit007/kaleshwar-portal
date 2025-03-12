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
                            <h5 class="backend-title mt-2">Booking details :: {{$booking->event->list_name}}</h5>
                        </div>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-md-3 p-0">
                        <h5 class="text-center border-bottom p-3 {{$booking->BookingStatusColor ??''}}">{{$booking->BookingStatusName ??''}}
                        </h5>
                        <div id="sidebar-edit-form" class="card-body px-0 py-4">
                            <div class="nav flex-column nav-pills text-center text-md-left" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active show" id="booking-basic-tab" data-toggle="tab" href="#booking-basic-form" role="tab" aria-controls="booking-basic-tab" aria-selected="true">Booking Basic Data</a>
                                @if($booking->bookingDetail)
                                    <a class="nav-link" id="booking-details-tab" data-toggle="tab" href="#booking-details-form" role="tab" aria-controls="booking-details-tab" aria-selected="true">Registration Details</a>
                                @elseif($booking->eventSection->has_registration)
                                    <a class="nav-link" id="booking-details-tab" data-toggle="tab" href="#booking-details-form" role="tab" aria-controls="booking-details-tab" aria-selected="true">Add Registration Details</a>
                                @endif
                            </div>
                        </div>
                        <hr class="mt-2 mb-3">
                        <div class="card-body p-3">
                            <h6 class="">Order of events for booking</h6>
                            <ul class="list-group list-scroll">
                                @foreach($booking->comments as $comment)
                                <li class="list-group-item bg-light">
                                    <span class="text-muted text-small">{{date_format(date_create($comment->created_at), 'd.m.Y')}}</span><br>
                                    {{$comment->content ??''}}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-9 p-0">
                        <div class="user-account-section p-0">
                            <div class="tab-content p-0" id="myTabContent">
                                <div class="tab-pane fade active show" id="booking-basic-form" role="tabpanel" aria-labelledby="booking-basic-tab">
                                    <form class="enable-able-form" method="post" action="{{ route('edit-booking', ['language' => app()->getLocale(), 'id' => $booking->id]) }}" enctype="multipart/form-data">@csrf
                                        <div class="button-bar">
                                            <button type="button" class="btn btn-outline-secondary edit-button btn-header">Edit</button>
                                            <button disabled hidden type="submit" class="btn btn-outline-success submit-button btn-header">Save</button>
                                        </div>

                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-lg-5">
                                                    <label for="participant">Participant °</label>
                                                    <input type="text" class="form-control" id="participant" value="{{$user->first_name ??''}} {{$user->last_name ??''}} {{$user->nickname ? '('.$user->nickname.')' : ''}}" readonly>
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label for="ticket">Ticket °</label>
                                                    <input type="text" class="form-control" id="ticket" value="{{$booking->id}}" readonly>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label for="booking_date">Booking at °</label>
                                                    <input type="text" class="form-control" id="booking_date" value="{{date_format(date_create($booking->created_at), 'd.m.Y H:i')}}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-lg-5">
                                                    <label for="last_name">Selection | Regular price °</label>
                                                    <input name="last_name" type="text" class="form-control" id="last_name"
                                                           value="{{$eventSection->eventSectionDetails[0]->title}} | @switch($booking->currency) @case('1'){{$booking->eventSection->price_usd ??''}} $ @break @case('2'){{$booking->eventSection->price_euro}} € @break @default ./. @break @endswitch" readonly>
                                                </div>
                                                @if($booking->event->has_date)
                                                    <div class="form-group col-lg-4">
                                                        <label for="nickname">Event Date °</label>
                                                        <input type="text" class="form-control" id="nickname" value="@if($booking->event->start_date) {{ date_format(date_create($booking->event->start_date), "d.m.Y") }} - @endif @if($booking->event->end_date) {{ date_format(date_create($booking->event->start_date), "d.m.Y") }} @endif" readonly>
                                                    </div>
                                                @endif
                                                <div class="form-group col-lg-3">
                                                    <label for="event_section_price">Booking price °</label>
                                                    <span class="input-group-text">{{$booking->event_section_price ??''}} @switch($booking->currency) @case('1') $ @break @case('2') € @break @default ./. @break @endswitch</span>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <label for="booking_message">Booking message</label>
                                                    <textarea id="booking_message" name="booking_message" class="form-control" rows="5" disabled>{{$booking->booking_message ??''}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-row pb-0 mt-2">
                                                <div class="form-group">
                                                    <label class="color-gray">° These fields are readonly</label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="booking-details-form" role="tabpanel" aria-labelledby="booking-details-tab">
                                    <form class="enable-able-form" method="post"
                                        @if($booking->bookingDetail)
                                            action="{{ route('edit-booking-details', ['language' => app()->getLocale(), 'id' => $booking->bookingDetail->id]) }}"
                                        @else
                                            action="{{ route('add-booking-details-admin', ['language' => app()->getLocale()]) }}"
                                        @endif
                                          enctype="multipart/form-data">@csrf
                                        <div class="button-bar">
                                            @if($booking->bookingDetail)
                                                <button type="button" class="btn btn-outline-secondary edit-button btn-header">Edit</button>
                                                <button disabled hidden type="submit" class="btn btn-outline-success submit-button btn-header">Save</button>
                                            @else
                                                <button type="submit" class="btn btn-outline-success submit-button btn-header">Save</button>
                                                <input type="hidden" name="booking_id" value="{{$booking->id}}">
                                            @endif
                                        </div>

                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-sm-6 col-md-4">
                                                    <label for="arrival_ashram">Arrival Date *</label>
                                                    <input required type="date" class="form-control" id="arrival_ashram" name="arrival_ashram" @if($booking->bookingDetail) value="{{$booking->bookingDetail->arrival_ashram ??''}}" disabled @endif>
                                                </div>
                                                <div class="form-group col-sm-6 col-md-4">
                                                    <label for="departure_ashram">Departure Date *</label>
                                                    <input required type="date" class="form-control" id="departure_ashram" name="departure_ashram" @if($booking->bookingDetail) value="{{$booking->bookingDetail->departure_ashram ??''}}" disabled @endif>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-sm-6 col-md-4">
                                                    <label for="transportation">Transportation to the Ashram</label>
                                                    <select class="form-control" id="transportation" name="transportation" @if($booking->bookingDetail) disabled @endif>
                                                        <option value="0" @if($event && $event->use_booking == '0') selected @endif>No selection</option>
                                                        <option value="1" @if($booking->bookingDetail && $booking->bookingDetail->transportation == '1') selected @endif>Ashram Car</option>
                                                        <option value="2" @if($booking->bookingDetail && $booking->bookingDetail->transportation == '2') selected @endif>Myself</option>
                                                    </select>

                                                </div>
                                                <div class="form-group col-sm-6 col-md-4">
                                                    <label for="arrival_india">Arrival in India</label>
                                                    <input type="{{$booking->bookingDetail && $booking->bookingDetail->arrival_india ? 'date' : 'text'}}" class="form-control" id="arrival_india" name="arrival_india" @if($booking->bookingDetail) value="{{$booking->bookingDetail->arrival_india ??''}}" disabled @endif>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-sm-12">
                                                    <label for="roommate_preference">Roomate preference</label>
                                                    <textarea class="form-control" id="roommate_preference" name="roommate_preference" maxlength="190" rows="2" @if($booking->bookingDetail) disabled @endif>{{$booking->bookingDetail->roommate_preference ??''}}</textarea>
                                                </div>
                                            </div>

                                            {{--                                    <div class="form-row">--}}
                                            {{--                                        <div class="form-group col-sm-12">--}}
                                            {{--                                            <label for="medical_requirements">List any health conditions and your physical, medical or dietary requirements</label>--}}
                                            {{--                                            <textarea class="form-control" id="medical_requirements" name="medical_requirements" rows="3" placeholder="Please let us know if you are you allergic to any medications or do you have any other important requirement..."></textarea>--}}
                                            {{--                                        </div>--}}
                                            {{--                                    </div>--}}


                                            <div class="form-row">
                                                <div class="form-group col-sm-12">
                                                    <label for="emergency_contact">Emergency contact *</label>
                                                    <textarea required class="form-control" id="emergency_contact" name="emergency_contact" maxlength="190" rows="2" @if($booking->bookingDetail) disabled @endif>{{$booking->bookingDetail->emergency_contact ??''}}</textarea>
                                                </div>
                                            </div>

                                            <input type="checkbox" class="custom-control-input" id="agreement_to_rules" name="agreement_to_rules" checked hidden>

                                            <div class="form-row pb-0 mt-2">
                                                <div class="form-group">
                                                    <label class="color-gray">* These fields are required</label>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        let path_name = location.pathname.substring(location.pathname.lastIndexOf('/') + 1);
        $('.nav a[id="' + path_name + '"]').addClass('active');
    });
</script>

@endsection
