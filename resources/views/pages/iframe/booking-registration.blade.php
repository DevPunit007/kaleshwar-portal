@extends('templates.iframe')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row iframe-view">
        @if($status === 'success')
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                    <p>{{ __('iframe-events.registration-message-part1') }} <strong><u>{{$event->EventDetailLanguage->title}}</u></strong> {{ __('iframe-events.registration-message-part2') }} <strong><u>{{$booking->EventSectionDetailLanguage->title ??'(missing translation)'}}</u></strong>. <br>
                        {{ __('iframe-events.registration-message-part3') }}: <strong>{{$booking->id}}</strong></p>
                    <p>{{ __('iframe-events.registration-instructions') }}.
                    {{ __('iframe-events.event-instructions') }}.</p>
                </div>
            </div>
        @endif
        <div class="col-md-8 col-sm-12">
            <div class="row event-details">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            Additional information for your registration
                        </div>
                        <div class="card-body">

                            <form method="post" action="{{ route('add-registration-details', app()->getLocale()) }}" enctype="multipart/form-data">@csrf
                                <input type="hidden" name="booking_id" value="{{$booking->id}}">

                                @if($status === 'success')
                                    <div class="flex-row">
                                        <h5 class="col-12 mb-1 mt-2 card-subtitle">Arrival and Departure at the Ashram</h5>
                                    </div>
                                    <p class="mt-4">Please fill in the dates you will arrive/depart the Ashram in Penukonda:</p>
                                    <div class="row">
                                        <div class="form-group col-sm-6 col-md-4">
                                            <label for="arrival_ashram">Arrival Date Ashram *</label>
                                            <input type="date" class="form-control" id="arrival_ashram" name="arrival_ashram" required @if($event->has_date && $booking->eventSection->has_registration == 1) min="{{\Carbon\Carbon::createFromDate($event->start_date)->subDay(1)->format('Y-m-d')}}" max="{{\Carbon\Carbon::createFromDate($event->end_date)->format('Y-m-d')}}" value="{{\Carbon\Carbon::createFromDate($event->start_date)->subDay(1)->format('Y-m-d')}}" @endif>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4">
                                            <label for="departure_ashram">Departure Date Ashram *</label>
                                            <input type="date" class="form-control" id="departure_ashram" name="departure_ashram" required @if($event->has_date && $booking->eventSection->has_registration == 1) min="{{\Carbon\Carbon::createFromDate($event->start_date)->format('Y-m-d')}}" max="{{\Carbon\Carbon::createFromDate($event->end_date)->addDay(1)->format('Y-m-d')}}" value="{{\Carbon\Carbon::createFromDate($event->end_date)->addDay(1)->format('Y-m-d')}}" @endif>
                                        </div>
                                    </div>
                                    @if($event->event_category_id == 7)
                                        <p>{{ __('iframe-events.registration-visit-period') }}</p>
                                    @else
                                        <p>{{ __('iframe-events.registration-program-period') }}</p>
                                    @endif
{{--                                    <p class="mt-3">If you already know your plan about the transportation.</p>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="form-group col-sm-6 col-md-8">--}}
{{--                                            <label for="transportation">Select your transportation to the Ashram</label>--}}
{{--                                            <select class="custom-select" id="transportation" name="transportation">--}}
{{--                                                <option value="" selected>Choose...</option>--}}
{{--                                                <option value="1">I want to book a pickup from the airport</option>--}}
{{--                                                <option value="2">I come at my own to the Ashram</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-sm-6 col-md-4">--}}
{{--                                            <label for="arrival_india">Arrival Date India</label>--}}
{{--                                            <input type="date" class="form-control" id="arrival_india" name="arrival_india">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <h5 class="card-subtitle">Roomate preference</h5>
                                    <p>We will do our best to accomodate any rooming requests, although it is not always possible.</p>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <input type="text" class="form-control" id="roommate_preference" name="roommate_preference" maxlength="190" value="{{ old('roommate_preference') }}" placeholder="If this field is left blank, we will assign you a roommate.">
                                        </div>
                                    </div>

{{--                                    <h5 class="card-subtitle">Medical requirements</h5>--}}
{{--                                    <p>Please make sure your medical information is accurate. When attending an event, it is important that we are aware of any medical conditions or special needs, so we can ensure the proper facilities and support are available. This information is private and kept in strict confidence.</p>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="form-group col-sm-12">--}}
{{--                                            <label for="medical_requirements">List any health conditions and your physical, medical or dietary requirements</label>--}}
{{--                                            <textarea class="form-control" id="medical_requirements" name="medical_requirements" rows="3" placeholder="Please let us know if you are you allergic to any medications or do you have any other important requirement..."></textarea>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <h5 class="card-subtitle">Emergency contact *</h5>
                                    <p>In case of emergency who of your family or friends can be contacted from our staff?</p>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <textarea class="form-control" id="emergency_contact" name="emergency_contact" maxlength="190" placeholder="Please provide First Name, Last Name, Address, Contact number, E-mail address" rows="2" required>{{ old('emergency_contact') }}</textarea>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="text-muted">* Mandatory inputs</label>
                                    </div>

                                    <h5 class="card-subtitle">Transportation and Flight details</h5>
                                    <p>
                                        For your stay at the Ashram we need more information regarding airport pickup, arrival time and flight details.
                                        Please enter this data in the form for your booking in the Ashram Portal.
                                        You can find the link to the Ashram Portal in your User account.
                                    </p>

                                    <h5 class="card-subtitle">Ashram rules and conducts</h5>
                                    <p>All students who visited the Ashram when Swami was here will know the high standards and guidelines that our beloved Guruji had us follow.
                                        To maintain the beautiful vibrations of this holy sacred place, it is especially important that we continue to follow these guidelines to the highest standard whenever we visit the Ashram.
                                        Each and every one of us has a responsibility to uphold and follow the guidelines.
                                        By doing so we become a good example to others and help in creating unity.
                                        It is our duty as Swami students to support the divine vibrations of this holy place in honor of our beloved Guruji by being self-responsible and respecting the guidelines and one another.
                                        {{--Please prepare yourself by reading our “Ashram Orientation” which you find as pdf document in your student account as a downloadable file. --}}Thank you.</p>
{{--                                    <strong>Agreement:</strong>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
                                        <input type="checkbox" class="custom-control-input" id="agreement_to_rules" name="agreement_to_rules" checked hidden>
{{--                                        <label class="custom-control-label" for="agreement_to_rules">--}}
{{--                                            <div class="ml-2">--}}
{{--                                                <p>Yes, I understand and agree with rules & Ashram conducts</p>--}}
{{--                                            </div>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}

                                @else
                                    Event booking failed.
                                @endif



                                <div class="mt-5 mb-3">
                                    <button class="btn btn-outline-primary" type="submit" >Save your travel information</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="row">
                <div class="col-12">

                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="event-details-table-sidebar">
                                <tr><td>Event:</td><td>{{$event->eventDetailLanguage->title}}</td></tr>
                                <tr><td>Selection:</td><td>{{$booking->EventSectionDetailLanguage->title}}</td></tr>
                                @if($event->has_date)
                                    @if($event->start_date)
                                        <tr><td>{{ __('iframe-events.start-date') }}:</td><td>{{date("d M Y", strtotime($event->start_date))}} </td></tr>
                                        <tr><td>{{ __('iframe-events.end-date') }}:</td><td>{{date("d M Y", strtotime($event->end_date))}}</td></tr>
                                    @else
                                        <tr><td>{{__('iframe-user-account.date')}}:</td><td>{{date("d M Y", strtotime($event->end_date))}}</td></tr>
                                    @endif
                                @endif
                                <tr><td>{{ __('iframe-events.organizer') }}:</td><td>{{$event->organizer->organizer_name}}</td></tr>
                                <tr><td>{{ __('iframe-events.contact') }}:</td><td>{{$event->userInformation->first_name}} {{$event->userInformation->last_name}} </td></tr>
                                <tr><td>{{ __('iframe-events.location') }}:</td><td>{{$event->locationDetails->name}}{{$event->locationDetails->country ? ', ' . $event->locationDetails->country : ''}} </td></tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <pre>
        @php //print_r($event); @endphp
        </pre>

    </div>
@endsection

