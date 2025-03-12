@extends('templates.iframe')

@section('content')
<div class="row iframe-view">
    <div class="col-lg-9 col-12">
        @foreach($organizers as $organizer)
            <div class="row event">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-7 col-xs-12">
                                    <h3 class="card-title title">{{$organizer->organizer_name}}</h3>
{{--                                    @isset($organizer->organizerDetails[0]->introduction)--}}
{{--                                        <p>{!! $organizer->organizerDetails[0]->introduction !!}</p>--}}
{{--                                    @endisset--}}
                                    <div class="d-none">
                                        @foreach($organizer->all_topics as $topic)
                                            <span class="event-category">{{$topic->name}} </span>
                                        @endforeach
                                    </div>
                                    <a class="btn btn-outline-primary btn-event-info mr-2" target="_self" href="{{ route('iframe-organizer-edit', ['language' => app()->getLocale(), 'id' => $organizer->id]) }}">{{__('iframe-organizer.button-details')}}</a>           {{--  --}}
                                </div>
                                <div class="d-block d-sm-none border-bottom w-100 my-4"></div>
                                <div class="col-sm-5 col-xs-12">
                                    <p><span><i class="far fa-users-class mr-2"></i><span class="introduction">{{ trans_choice('app.'.$organizer->type, 1) }}</span></span></p>
                                    <p><span><i class="far fa-map-marked-alt mr-2"></i>@isset($organizer->organizerContactInformation->country)<span class="organizer-country introduction">{{ __('countries.'.$organizer->organizerContactInformation->country)}}</span>@endisset @if(isset($organizer->organizerContactInformation->city) && isset($organizer->organizerContactInformation->country)) - @endif @isset($organizer->organizerContactInformation->city)<span class="organizer-city introduction">{{$organizer->organizerContactInformation->city}}</span>@endisset</span></p>
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
                <h5>{{__('iframe-organizer.filter-search')}}</h5>
                <div class="form-group">
                    <label for="title-subtitle-introduction-search">{{__('iframe-organizer.search')}}</label>
                    <input type="text" id="title-subtitle-introduction-search"  class="form-control">
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="category">{{__('iframe-organizer.choose-topic')}}</label>
                    <select size="{{count($topics)+count($teachings)+4}}" id="category"  class="form-control">
                        <option value=""></option>
                        <option disabled>-- {{ __('iframe-organizer.general_topics') }} --</option>
                        @foreach($topics as $topic)
                            <option value="{{$topic->id}}">{{$topic->name}}</option>
                        @endforeach
                        <option value=""></option>
                        <option disabled>-- {{ __('iframe-organizer.certified_teachings') }} --</option>
                        @foreach($teachings as $teaching)
                            <option value="{{$teaching->id}}">{{$teaching->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <pre>
    @php //print_r($organizers); @endphp
    </pre>
</div>

@endsection
