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
                            <h5 class="backend-title mt-2">Add new translation for {{$event->eventDetails[0]->title}}</h5>
                        </div>
                        <div class="col-auto text-right">
                            <button onclick="window.location.href = '{{ route('event-edit', ['language' => app()->getLocale(), 'id' => $event->id]) }}';" type="button" class="btn btn-outline-dark btn-header">Back</button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('event-add-translation', ['language' => app()->getLocale(), 'id' => $event->id]) }}">@csrf
                        <div class="form-group">
                            <label for="event-language">Language</label>
                            <select name="event_language" id="event-language" class="custom-select col-lg-6 col-sm-12">
                                @foreach($languages as $language)
                                    <option value="{{$language}}">{{__('login.language.' . $language)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label for="title">Title *</label>
                                <input id="title" name="title" class="form-control" value="{{$event->eventDetails[0]->title}}" required>
                                @error('title')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label for="introduction">Introduction</label>
                                <input id="introduction" name="introduction" class="form-control" value="{{$event->eventDetails[0]->introduction}}">
                                @error('introduction')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="5" class="form-control add_tinymce">{{ $event->eventDetails[0]->description }}</textarea>
                                @error('description')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label for="before_booking">Message before booking</label>
                                <input id="before_booking" name="before_booking" class="form-control" value="{{$event->eventDetails[0]->before_booking}}">
                                @error('before_booking')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <hr>

                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label for="intro_booking">Booking Intro Text</label>
                                <input id="intro_booking" name="intro_booking" class="form-control" value="{{$event->eventDetails[0]->intro_booking}}">
                                @error('intro_booking')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label for="closing_booking">Booking Closing Text</label>
                                <input id="closing_booking" name="closing_booking" class="form-control" value="{{$event->eventDetails[0]->closing_booking}}">
                                @error('closing_booking')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <hr>

                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label for="after_booking">After booking</label>
                                <textarea id="after_booking" name="after_booking" rows="5" class="form-control add_tinymce">{{ $event->eventDetails[0]->after_booking }}</textarea>
                                @error('after_booking')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
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
</div>
@endsection
