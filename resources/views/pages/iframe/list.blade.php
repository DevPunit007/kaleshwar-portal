@extends('templates.iframe')

@section('content')
<div class="row iframe-view">
    <div class="col-lg-9 col-12">
        @foreach($events as $event)
            <div class="row event">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8 col-xs-12">
                                    <h3 class="card-title title">{{$event->eventDetailLanguage->title}}</h3>
                                    <div class="introduction">
                                        @if(strlen($event->eventDetailLanguage->introduction) >180) {{ substr($event->eventDetailLanguage->introduction, 0, 180) }}... @else {{$event->eventDetailLanguage->introduction}} @endif
                                    </div>
                                    <a class="btn btn-outline-primary btn-event-info" target="_parent" href="https://www.srikaleshwar.world/{{app()->getLocale()}}/events/ashram-events?{{$event->id}}">{{__('iframe-events.button-details')}}</a>           {{-- {{ route('iframe-details', ['language' => app()->getLocale(), 'id' => $event->id]) }} --}}
                                </div>
                                <div class="d-block d-sm-none border-bottom w-100 my-4"></div>
                                <div class="col-sm-4 col-xs-12 event-sidebar">
                                    <p><i class="far fa-calendar mr-2"></i>
                                    @if(app()->getLocale() == 'de')
                                        @if($event->start_date) {{date("d.m.Y", strtotime($event->start_date))}} - @endif @if($event->end_date) {{date("d.m.Y", strtotime($event->end_date))}} @endif
                                    @else
                                        @if($event->start_date) {{date("d/m/Y", strtotime($event->start_date))}} - @endif @if($event->end_date) {{date("d/m/Y", strtotime($event->end_date))}} @endif
                                    @endif
                                    </p>
                                    <p><i class="far fa-users-class mr-2"></i>{{$event->organizer->organizer_name}}</p>
                                    <p class="event-category"><i class="far fa-tag mr-2"></i>{{ __($event->eventCategory->event_category_name) }}</p>
                                    <p class="location"><i class="far fa-map-marked-alt mr-2"></i>{{$event->locationDetails->name}}{{$event->locationDetails->city ? ', ' . $event->locationDetails->city : ''}}{{$event->locationDetails->country ? ', ' . $event->locationDetails->country : ''}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-lg-3 col-12">
        <div class="row">
            <div class="col-12">
                <h5>{{__('iframe-events.filter-search')}}</h5>
                <div class="form-group">
                    <label for="title-subtitle-introduction-search">{{__('iframe-events.search')}}</label>
                    <input type="text" id="title-subtitle-introduction-search"  class="form-control">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="category">{{__('iframe-events.choose-category')}}</label>
                    <select size="{{count($eventCategories)+1}}" id="category"  class="form-control">
                        <option value=""></option>
                        @foreach($eventCategories as $category)
                            <option value="{{$category->id}}">{{ __($category->event_category_name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <pre>
    @php //print_r($events); @endphp
    </pre>
</div>

@endsection
