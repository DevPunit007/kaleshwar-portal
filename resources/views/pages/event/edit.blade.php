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
                                <h5 class="backend-title mt-2">Edit event :: {{$event->eventDetails[0]->title}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col-md-3 p-0">
                            <div class="card-body px-0 py-4">
                                <div class="nav flex-column nav-pills text-center text-md-left" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                                    <a class="nav-link active show" id="basic-data-tab" data-toggle="tab" href="#basic-data-Form" role="tab" aria-controls="basic-data-Tab" aria-selected="true">Event base data</a>
                                    @foreach($event->eventDetails as $eventDetail)
                                        <a class="nav-link" id="{{$eventDetail->language}}-tab" data-toggle="tab" href="#{{$eventDetail->language}}Form" role="tab" aria-controls="{{$eventDetail->language}}Tab" aria-selected="true">Event details: {{__('login.language.' . $eventDetail->language)}}</a>
                                    @endforeach
                                    <a class="nav-link" href="{{route('event-add-translation', ['language' => app()->getLocale(), 'id' => $event->id]) }}">Add Translation</a>

                                    <a class="nav-link mt-4" href="{{route('event-section-add', ['language' => app()->getLocale(), 'id' => $event->id]) }}">Add Section</a>

                                    {{--<a class="nav-link " id="" href="{{ route('event-add-translation', ['language' => app()->getLocale(), 'id' => $event->id]) }}">Participant Overview</a>--}}
                                    <a class="nav-link mt-4" id="event-report-message" href="{{ route('event-report-message', ['language' => app()->getLocale(), 'id' => $event->id]) }}">Participants with Messages</a>
                                    <a class="nav-link" id="event-report-address" href="{{ route('event-report-address', ['language' => app()->getLocale(), 'id' => $event->id]) }}">Participants with Address</a>
                                    <a class="nav-link" id="event-report-user-details" href="{{ route('event-report-user-details', ['language' => app()->getLocale(), 'id' => $event->id]) }}">Participants with User details</a>
                                    @if($event->eventSections->contains('has_registration', 1))
                                        <a class="nav-link" id="event-report-booking-details" href="{{ route('event-report-booking-details', ['language' => app()->getLocale(), 'id' => $event->id]) }}">Participants with Booking details</a>
                                    @endif
                                    <a class="nav-link mt-4" id="event-report-address" href="{{ route('iframe-details', ['language' => app()->getLocale(), 'id' => $event->id]) }}" target="_blank">Preview event page</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 p-0">
                            <div class="user-account-section p-0">
                                <div class="tab-content p-0" id="myTabContent">
                                    <div class="tab-pane fade active show" id="basic-data-Form" role="tabpanel" aria-labelledby="basic-data-tab">
                                        <div class="card-body">
                                            <form id="edit-event-basic-form" class="enable-able-form" action="{{ route('event-edit', ['language' => app()->getLocale(), 'id' => $event->id]) }}" method="post">@csrf
                                                <div class="button-bar">
                                                    <button onclick="if(confirm('Do you sure you want to clone the event: {{$event->eventDetails[0]->title}} ?')) {window.location.href = '{{ route('event-clone', ['id' => $event->id,'language' => app()->getLocale()]) }}';}" type="button" class="btn btn-outline-info mx-1">Clone</button>
                                                    <button disabled hidden type="submit" class="btn btn-outline-success submit-button mx-1">Save</button>
                                                    <button type="button" class="btn btn-outline-secondary edit-button mx-1">Edit</button>
                                                    <button onclick="window.location.href = '{{ route('event-list', ['language' => app()->getLocale()]) }}';" type="button" class="btn btn-outline-dark mx-1">Back</button>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-6">
                                                        <label for="list_name">Internal list name (max 25 letters) *</label>
                                                        <input disabled id="list_name" name="list_name" class="form-control" maxlength="25" value="{{$event->list_name}}" required>
                                                        @error('list_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="event-category-id">Event Category *</label>
                                                        <select disabled name="event_category_id" id="event-category-id" class="custom-select" required>
                                                            @foreach($eventCategories as $category)
                                                                <option @if($category->id === $setCategoryId) selected @endif value="{{$category->id}}">{{$category->event_category_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-sm-2">
                                                        <div class="form-check mt-4">
                                                            <input class="form-check-input" type="checkbox" id="has_date" name="has_date" {{ $event->has_date !== 0 ? 'checked' : ''}} disabled>
                                                            <label class="form-check-label" for="has_date">
                                                                Has Date
                                                            </label>
                                                        </div>
                                                        @error('has_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label for="start-date">Start Date</label>
                                                        <input disabled id="start-date" name="start_date" class="form-control" value="{{$event->start_date}}" type="date">
                                                        @error('start_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label for="end-date">End Date</label>
                                                        <input disabled id="end-date" name="end_date" class="form-control" value="{{$event->end_date}}" type="date">
                                                        @error('end_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                </div>

{{--                                                <div class="form-row">--}}
{{--                                                    <div class="form-group col-lg-6">--}}
{{--                                                        <label for="start-date">Start Time</label>--}}
{{--                                                        <input disabled id="start-date" type="time" name="start_date" class="form-control" value="{{$event->start_time}}">--}}
{{--                                                        @error('start_time')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-group col-lg-6">--}}
{{--                                                        <label for="end-date">End Time</label>--}}
{{--                                                        <input disabled id="end-date" type="time" name="end_date" class="form-control" value="{{$event->end_time}}">--}}
{{--                                                        @error('end_time')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

                                                <hr>

                                                <div class="form-row">
                                                    <div class="form-group col-lg-6">
                                                        <label for="location-id">Location *</label>
                                                        <select disabled name="location_id" id="location-id" class="custom-select" required>
                                                            @foreach($locations as $location)
                                                                <option @if($location->id === $event->location_id) selected @endif value="{{$location->id}}">{{$location->locationDetails[0]->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="room-id">Room</label>
                                                        <select disabled name="room_id" id="room-id" class="custom-select">
                                                            <option value="">No Room</option>
                                                            @foreach($rooms as $room)
                                                                <option @if($room->id === $event->room_id) selected @endif value="{{$room->id}}">{{$room->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-lg-6">
                                                        <label for="organizer-id">Sri Kaleshwar Group *</label>
                                                        <select disabled name="organizer_id" id="organizer-id" class="custom-select" required>
                                                            @foreach($eventOrganizers as $eventOrganizer)
                                                                <option @if($setEventOrganizer === $eventOrganizer->id) selected @endif value="{{$eventOrganizer->id}}">{{$eventOrganizer->organizer_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="event-category-id">Contact Person *</label>
                                                        <select disabled name="event_contact_person_id" id="event-contact-person-id" class="custom-select" required>
                                                            <option value="{{$setContactPerson->id}}">{{$setContactPerson->first_name}} {{$setContactPerson->last_name}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-sm-3">
                                                        <label for="use_booking">Booking Type *</label>
                                                        <select disabled name="use_booking" id="use_booking" class="form-control" required>
                                                            <option value="0" @if($event && $event->use_booking == '0') selected @endif>No booking</option>
                                                            <option value="1" @if($event && $event->use_booking == '1') selected @endif>Booking form</option>
                                                            <option value="2" @if($event && $event->use_booking == '2') selected @endif>E-Mail request</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-3">
                                                        <div class="form-check mt-4 ml-3">
                                                            <input class="form-check-input" type="checkbox" id="is_visible" name="is_visible" {{ $event->is_visible !== 0 ? 'checked' : ''}} disabled>
                                                            <label class="form-check-label" for="is_visible">
                                                                Is visible
                                                            </label>
                                                        </div>
                                                        @error('is_visible')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                </div>
                                            </form>

                                            <hr>

                                            @if(sizeof($event->eventSections) > 0)
                                                <h5 class="mt-5">Sections of this Event</h5>
                                                <table id="section-list-table" class="display" style="border-top: 1px solid #111;">
                                                    <thead class="d-none">
                                                        <tr>
                                                            <th class="table-icon"></th>
                                                            <th data-priority="1">Name</th>
                                                            <th>Price</th>
                                                            <th>Language</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($event->eventSections as $eventSection)
                                                        <tr>
                                                            <td class="nowrap table-icon">
                                                                <a href="{{ route('event-section-edit', ['language' => app()->getLocale(), 'id' => $eventSection->id]) }}"><i class="fas fa-chevron-circle-right fa-lg mx-1 color-theme-dark op-7"></i></a>
                                                            </td>
                                                            <td>{{$eventSection->eventSectionDetails[0]->title}}</td>
                                                            <td>{{$eventSection->price_usd ?: 0}} $ / {{$eventSection->price_euro ?: 0}} €</td>
                                                            <td>
                                                                @foreach($eventSection->eventSectionDetails as $eventSectionDetail)
                                                                    {{$eventSectionDetail->language}}
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <p class="text-muted">No Event Section in the database</p>
                                            @endif
                                        </div>
                                    </div>


                                    @foreach($event->eventDetails as $eventDetail)
                                        <div class="tab-pane fade" id="{{$eventDetail->language}}Form" role="tabpanel" aria-labelledby="{{$eventDetail->language}}-tab">
                                            <form id="edit-event-form-{{$eventDetail->language}}" class="enable-able-form" action="{{ route('event-details-edit', ['language' => app()->getLocale(), 'id' => $event->id]) }}" method="post">@csrf
                                                <div class="button-bar">
                                                    <button type="button" class="btn btn-outline-secondary edit-button">Edit</button>
                                                    <button disabled hidden type="submit" class="btn btn-outline-success submit-button">Save</button>
                                                    <button onclick="window.location.href = '{{ route('event-list', ['language' => app()->getLocale()]) }}';" type="button" class="btn btn-outline-dark">Back</button>
                                                </div>
                                                <div class="card-body">
                                                    <input id="language" name="language" hidden type="text" value="{{$eventDetail->language}}">

                                                    <div class="form-row">
                                                        <div class="form-group col-lg-12">
                                                            <label for="title">Title *</label>
                                                            <input disabled id="title" name="title" class="form-control" value="{{$eventDetail->title}}" required>
                                                            @error('title')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror

                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-lg-12">
                                                            <label for="introduction">Introduction</label>
                                                            <input disabled id="introduction" name="introduction" class="form-control" value="{{$eventDetail->introduction}}">
                                                            @error('introduction')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-lg-12">
                                                            <label for="description">Description</label>
                                                            <div height="auto" readonly class="form-div-control show_tinymce">{!! $eventDetail->description !!}</div>
                                                            <textarea disabled id="description" name="description" rows="5" class="form-control edit_tinymce d-none">{{ $eventDetail->description }}</textarea>
                                                            @error('description')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-lg-12">
                                                            <label for="before_booking">Message before booking</label>
                                                            <input disabled id="before_booking" name="before_booking" class="form-control" value="{{$eventDetail->before_booking}}">
                                                            @error('before_booking')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="form-row">
                                                        <div class="form-group col-lg-12">
                                                            <label for="intro_booking">Booking Intro Text</label>
                                                            <input disabled id="intro_booking" name="intro_booking" class="form-control" value="{{$eventDetail->intro_booking}}">
                                                            @error('intro_booking')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-lg-12">
                                                            <label for="closing_booking">Booking Closing Text</label>
                                                            <input disabled id="closing_booking" name="closing_booking" class="form-control" value="{{$eventDetail->closing_booking}}">
                                                            @error('closing_booking')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="form-row">
                                                        <div class="form-group col-lg-12">
                                                            <label for="after_booking">After booking</label>
                                                            <div height="auto" readonly class="form-div-control show_tinymce">{!! $eventDetail->after_booking !!}</div>
                                                            <textarea disabled id="after_booking" name="after_booking" rows="5" class="form-control edit_tinymce d-none">{{ $eventDetail->after_booking }}</textarea>
                                                            @error('after_booking')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>

    </script>
@endsection
