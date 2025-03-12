@extends('templates.iframe')

@section('content')
<div class="row iframe-view">
    <div class="col-md-8 col-sm-12">
        <div class="row event-details">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h6>{{__('iframe-events.event-details')}}</h6>
                    </div>
                    <div class="card-body">
                        @if($event)
                            <h5 class="card-title">{{$event->eventDetailLanguage->title ??''}}</h5>
                            <p>{{$event->eventDetailLanguage->introduction ??''}}</p>

                            @if($event->has_date)
                                @if(app()->getLocale() == 'de')
                                    @php
                                        $start_date_locale = Carbon\Carbon::parse($event->start_date)->locale('de_DE')->isoFormat('DD. MMMM YYYY (dddd)');
                                        $end_date_locale = Carbon\Carbon::parse($event->end_date)->locale('de_DE')->isoFormat('DD. MMMM YYYY (dddd)');
                                    @endphp
                                @else
                                    @php
                                        $start_date_locale = date("F d, Y (l)", strtotime($event->start_date));
                                        $end_date_locale = date("F d, Y (l)", strtotime($event->end_date));
                                    @endphp
                                @endif

                                <table class="event-details-table">
                                    @if($event->start_date)
                                        <tr><td>{{__('iframe-events.start-date')}}:</td><td>{{$start_date_locale ??''}}</td></tr>
                                        <tr><td>{{__('iframe-events.end-date')}}:</td><td>{{$end_date_locale ??''}}</td></tr>
                                    @else
                                        <tr><td>{{__('iframe-user-account.date')}}:</td><td>{{$end_date_locale ??''}}</td></tr>
                                    @endif
                                </table>
                            @endif

                            @if($event->eventDetailLanguage->description)
                                <h5 class="card-subtitle">{{__('iframe-events.description')}}</h5>
                                <p>{!! $event->eventDetailLanguage->description !!}</p>
                            @endif

                            <p class="my-5"><i>{{$event->eventDetailLanguage->before_booking}}</i></p>

                            <div class="mt-4 mb-3">
                            @if($event->use_booking == 1)
                                <a class="btn btn-outline-primary" href="{{ route('iframe-booking', ['language' => app()->getLocale(), 'id' => $event->id]) }}">{{__('iframe-events.button-booking')}}</a>
                             @elseif($event->use_booking == 2)
                                <a class="btn btn-outline-info" href="https://www.srikaleshwar.world/en/contact" target="_blank">{{__('iframe-events.button-request')}}</a>  {{-- type="submit" text:  --}}
                            @endif
                                <a type="button" class="btn btn-outline-dark mx-2" href="https://www.srikaleshwar.world/{{app()->getLocale()}}/events/ashram-events" target="_parent">{{__('iframe-events.button-back')}}</a>
                            </div>
                        @else
                            <div class="alert alert-warning">{{__('iframe-events.event-not-found')}}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="row">
            <div class="col-12">
                @isset($event->picture_link)
                <div class="card mb-4">
                    <img class="card-img" src="{{$event->picture_link}}" alt="Card image">
                </div>
                @endisset
                <div class="card mb-4">
                    <div class="card-body">
                        <table class="event-details-table-sidebar">
                            @if($event)
                                <tr><td>{{__('iframe-events.organizer')}}:</td><td>{{$event->organizer->organizer_name}}</td></tr>
                                <tr><td>{{__('iframe-events.contact')}}:</td><td>{{$event->userInformation->first_name}} {{$event->userInformation->last_name}} <a href="https://www.srikaleshwar.world/en/contact" target="_blank"><i class="far fa-envelope" data-toggle="tooltip" title="Click here to send a message to the contact"></i></a></td></tr>
                                <tr><td>{{__('iframe-events.location')}}:</td><td>{{$event->locationDetails->name}}{{$event->locationDetails->country ? ', ' . $event->locationDetails->country : ''}} </td></tr>
                            @endif
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
