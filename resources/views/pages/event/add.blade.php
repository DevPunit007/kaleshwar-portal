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
                            <h5 class="backend-title mt-2">Add Event</h5>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('event-add', app()->getLocale()) }}" enctype="multipart/form-data">@csrf

                        <div class="form-group ml-32">
                            <label for="event-language">Language</label>
                            <select name="event_language" id="event-language" class="custom-select col-lg-6 col-sm-12">
                                @foreach($languages as $language)
                                    <option value="{{$language->language_code}}">{{__('login.language.' . $language->language_code)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label for="title">Title *</label>
                                <input id="title" class="form-control" type="text" name="title" placeholder="" required>
                                @error('title')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label for="introduction">Introduction</label>
                                <input id="introduction" class="form-control" type="text" name="introduction" placeholder="">
                                @error('introduction')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <hr class="mt-2 mb-4">

                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="list_name">Internal list name (max 25 letters) *</label>
                                <input id="list_name" name="list_name" class="form-control" maxlength="25" value="" required>
                                @error('list_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="event-category-id">Event Category *</label>
                                <select name="event_category_id" id="event_category" class="custom-select" required>
                                    @foreach($eventCategories as $eventCategory)
                                        <option value="{{$eventCategory['id']}}"> {{$eventCategory['event_category_name']}}</option>
                                    @endforeach
                                </select>
                                @error('event_category')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="start-date">Start Date *</label>
                                <input id="start-date" class="form-control" type="text" name="start_date" placeholder="" required>
                                @error('start_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="end-date">End Date *</label>
                                <input id="end-date" class="form-control" type="text" name="end_date" placeholder="" required>
                                @error('end_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="location_id">Location ID *</label>
                                <select name="location_id" id="location_id" class="custom-select" required>
                                    @foreach($locations as $location)
                                        <option value="{{$location['id']}}"> {{$location->locationDetail['name']}}</option>
                                    @endforeach
                                </select>
                                @error('location')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="organizer">Sri Kaleshwar Group *</label>
                                <select name="organizer_id" id="organizer" class="custom-select" required>
                                    @foreach($organizers as $organizer)
                                        <option value="{{$organizer['id']}}">{{$organizer['organizer_name']}}</option>
                                    @endforeach
                                </select>
                                @error('organizer')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="contact-person">Teacher / Contact Person *</label>
                                <select name="event_contact_person_id" id="contact-person" class="custom-select" required>
                                    <option value="9000">Ashram Team</option>
                                </select>
                            </div>
                        </div>

                        <hr class="mt-2 mb-4">

                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="5" class="form-control add_tinymce"></textarea>
                                @error('description')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label for="before_booking">Message before booking</label>
                                <input id="before_booking" class="form-control" type="text" name="before_booking" placeholder="">
                                @error('before_booking')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <hr class="mt-2 mb-4">

                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label for="intro_booking">Booking Intro Text</label>
                                <input id="intro_booking" class="form-control" type="text" name="intro_booking" placeholder="">
                                @error('intro_booking')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label for="closing_booking">Booking Closing Text</label>
                                <input id="closing_booking" class="form-control" type="text" name="closing_booking" placeholder="">
                                @error('closing_booking')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <hr>

                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label for="after_booking">After booking</label>
                                <textarea id="after_booking" name="after_booking" rows="5" class="form-control add_tinymce"></textarea>
                                @error('after_booking')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <hr>

                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="use_booking">Booking Type</label>
                                <select name="use_booking" id="use_booking" class="form-control" required>
                                    <option value="0">No booking</option>
                                    <option value="1" selected>Booking form</option>
                                    <option value="2">E-Mail request</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button class="btn w-50 text-light mt-3 color-brand-blue" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <pre>
        @php //print_r($message); @endphp
    </pre>
@endsection
