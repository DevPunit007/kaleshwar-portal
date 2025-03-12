
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
	<div class="card rounded mb-2">
		<form class="enable-able-form" method="post" @if($timeline_media) action="{{ route('timeline-edit-media', ['language' => app()->getLocale(), 'id' => $timeline_media->id]) }}" @else action="{{ route('timeline-add-media', app()->getLocale()) }}" @endif enctype="multipart/form-data">@csrf

            <div class="card-header rounded-top">
                <div class="row">
                    <div class="col mr-auto">
                        <h5 class="backend-title mt-2">@if($timeline_media) Edit @else Add @endif Media Content in Timeline</h5>
                    </div>
                    <div class="col-auto text-right">
                        @if($timeline_media)
                        <button onclick="alert('Function Delete will come soon');" type="button" class="btn btn-outline-danger submit-button mx-1" disabled hidden>Delete</button>
                        <button onclick="alert('Function Log will come soon');" type="button" class="btn btn-outline-secondary mx-1">Change log</button>
                        @endif
                        <button onclick="window.location.href='{{ route('timeline-media-list', app()->getLocale()) }}';" type="button" class="btn btn-outline-secondary mx-1">Back</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 pr-0">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="date">Timeline Date *</label>
                                <input required name="date" type="date" class="form-control" id="date" value="{{$timeline_media->date ??''}}" @if($timeline_media) disabled @endif>
                            </div>
                            <div class="form-group col-lg-8">
                                <label for="time">Time</label>
                                <input name="time" type="text" class="form-control" id="time" placeholder="Please enter the space of time as text" value="@if($timeline_media){{$timeline_media->time ??''}}@else{{ old('time') }}@endif" @if($timeline_media) disabled @endif>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-7">
                                <label for="content">Content Info *</label>
                                <input required name="content" type="text" class="form-control" id="content" placeholder="Title or Summary of the media content" value="@if($timeline_media){{$timeline_media->content}}@else{{ old('content') }}@endif" @if($timeline_media) disabled @endif>
                            </div>
                            <div class="form-group col-lg-5">
                                <label for="event_id">Event organized by the Ashram</label>
                                <select name="event_id" id="event_id" class="form-control" @if($timeline_media) disabled @endif>
                                    <option value="" selected></option>
                                    @foreach($events as $event)
                                    <option value="{{$event->id}}" @if($timeline_media) @if($event->id == $timeline_media->event_id) selected @endif @else @if($event->id == old('event_id')) selected @endif @endif>@if($event->start_date) {{date("d.m.Y", strtotime($event->start_date))}} - @endif @if($event->end_date) {{date("d.m.Y", strtotime($event->end_date))}} @endif | {{$event->eventDetails[0]->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-5">
                                <label for="location_id">Select Location *</label>
                                <select required name="location_id" id="location_id" class="form-control" @if($timeline_media) disabled @endif>
                                    <option value="" selected>Please select a location from the list</option>
                                    @foreach($locations as $location)
                                    <option value="{{$location->id ??''}}" @if($timeline_media) @if($location->id == $timeline_media->location_id) selected @endif @else @if($location->id == old('location_id')) selected @endif @endif >{{$location->locationDetails[0]->country ??''}} | {{$location->locationDetails[0]->name ??''}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-7">
                                <label for="location_info">Additional Location Info</label>
                                <input name="location_info" type="text" class="form-control" id="location_info" value="@if($timeline_media){{$timeline_media->location_info}}@else{{ old('location_info') }}@endif" @if($timeline_media) disabled @endif>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="type">Select Media Type *</label>
                                <select required name="type" id="type" class="form-control" @if($timeline_media) disabled @endif>
                                    <option value="" hidden disabled selected>Please select a media type</option>
                                    <option value="Text" @if($timeline_media) @if($timeline_media->type == 'Text') selected @endif @else @if( old('type') == 'Text') selected @endif @endif>Text</option>
                                    <option value="Photo" @if($timeline_media) @if($timeline_media->type == 'Photo') selected @endif @else @if( old('type') == 'Photo') selected @endif @endif>Photo</option>
                                    <option value="Video" @if($timeline_media) @if($timeline_media->type == 'Video') selected @endif @else @if( old('type') == 'Video') selected @endif @endif>Video</option>
                                    <option value="Audio" @if($timeline_media) @if($timeline_media->type == 'Audio') selected @endif @else @if( old('type') == 'Audio') selected @endif @endif>Audio</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="format">Media format</label>
                                <input name="format" type="text" class="form-control" id="format" placeholder="File format (JPG, TIF, AVI, MPG ... )" value="@if($timeline_media){{$timeline_media->format}}@else{{ old('format') }}@endif" @if($timeline_media) disabled @endif>
                            </div>
                        </div>
                        <div class="form-row">

                        </div>


                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="speaker">Speaker</label>
                                <input name="speaker" type="text" class="form-control" id="speaker" value="@if($timeline_media){{$timeline_media->speaker}}@else{{ old('speaker') }}@endif" @if($timeline_media) disabled @endif>
                            </div>
                            <div class="form-group col-lg-6">
                            <label for="translation">Translation</label>
                            <input name="translation" type="text" class="form-control" id="translation" value="@if($timeline_media){{$timeline_media->translation}}@else{{ old('translation') }}@endif" @if($timeline_media) disabled @endif>
                        </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="duration">Duration</label>
                                <input name="duration" type="text" class="form-control" id="format" placeholder="Input format is hh:mm:ss" value="@if($timeline_media){{$timeline_media->duration}}@else{{ old('duration') }}@endif" @if($timeline_media) disabled @endif>
                            </div>
                            <div class="form-group col-lg-8">
                                <label for="quality">Media Quality</label>
                                <input name="quality" type="text" class="form-control" id="quality" value="@if($timeline_media){{$timeline_media->quality}}@else{{ old('quality') }}@endif" @if($timeline_media) disabled @endif>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="reference_info">Reference Info</label>
                            <input name="reference_info" type="text" class="form-control" id="reference_info" value="@if($timeline_media){{$timeline_media->reference_info}}@else{{ old('reference_info') }}@endif" @if($timeline_media) disabled @endif>
                        </div>
                        <div class="form-group">
                            <label for="notes">Notes about the Media Content</label>
                            <textarea name="notes" class="form-control" id="notes" rows="2" @if($timeline_media) disabled @endif>@if($timeline_media){{$timeline_media->notes}}@else{{ old('notes') }}@endif</textarea>
                        </div>

                        <div class="form-group pb-0">
                            <label class="color-gray">* These fields are required</label>
                            @if($timeline_media)<button type="button" class="btn btn-dark edit-button">Edit</button>@endif
                            <button @if($timeline_media) disabled hidden @endif type="submit" class="btn btn-primary submit-button">Save</button>
                        </div>


                    </div>
                </div>

                <div class="col-lg-4 pl-0" style="border-left: 1px solid lightgray;">
                    <div class="card-body">


                        <div class="form-group col-12">
                            <label for="keyword">New Keyword (DEMO)</label>
                            <div class="input-group mb-3">
                                <input name="keyword" type="text" class="form-control" id="keyword" placeholder="Keywords for the media content" aria-label="keyword" aria-describedby="button-keywords">
                                <div class="input-group-append">
                                <button onclick="alert('Function Keywords will come soon');" class="btn btn-outline-secondary" type="button" id="button-keywords">Save</button>
                              </div>
                            </div>
                        </div>


                        <ul class="list-group">
                            <li class="list-group-item card-header color-gray">List of Keywords (DEMO)</li>
                            <li class="list-group-item">Mantra</li>
                            <li class="list-group-item">Kala Chakra</li>
                            <li class="list-group-item">Mount Kailash</li>
                        </ul>
                    </div>
                </div>
            </div>

		</form>
	</div>
</div>

<pre>@php //print_r($timeline_media); @endphp </pre>

@endsection
