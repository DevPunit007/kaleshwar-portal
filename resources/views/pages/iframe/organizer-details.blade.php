@extends('templates.iframe')

@section('content')
<div class="row iframe-view">
    @if($organizer)
    <div class="col-md-8 col-sm-12">
        <div class="row event-details">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h6>{{ trans_choice('app.'.$organizer->type, 1) }} Details</h6>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$organizer->organizer_name ??''}}</h5>
                        @isset($organizer->organizerDetailLanguage->description)
                            <h5 class="card-subtitle">{{__('iframe-events.description')}}</h5>
                            <p>{!! $organizer->organizerDetailLanguage->description !!}</p>
                        @endisset

                        @if(count($organizer->topics))
                            @if($organizer->type == 'teacher')
                                <h5 class="card-subtitle">{{__('iframe-organizer.subtitle-topics')}}</h5>
                            @else
                                <h5 class="card-subtitle">{{__('iframe-organizer.subtitle-acticities')}}</h5>
                            @endif
                            <div class="d-flex flex-wrap">
                                @foreach($organizer->topics as $topic)
                                    <div class="text-nowrap pr-4 pb-2">&bull; {{$topic->name}}</div>
                                @endforeach
                            </div>
                        @endif


                        @if($organizer->type == 'teacher' && count($organizer->teachings) > 0)
                            @empty(!$organizer->teachings)
                            <h5 class="card-subtitle">{{__('iframe-organizer.subtitle-teachings')}}</h5>
                            <div class="d-flex flex-wrap">
                                @foreach($organizer->teachings as $teaching)
                                    <div class="text-nowrap pr-4 pb-2">&bull; {{$teaching->name}}</div>
                                @endforeach
                            </div>
                            @endempty
                        @endif

                        <div class="mt-5 mb-3">
                            <a type="button" class="btn btn-outline-dark mx-2"
                               @if(app()->getLocale() == 'de')
                                    href="https://www.srikaleshwar.world/de/events/lehrer-gruppen"
                                @else
                                    href="https://www.srikaleshwar.world/en/events/teachers-groups"
                                @endif
                                    target="_parent">{{__('iframe-events.button-back')}}</a>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <table id="section-list-table" class="display">
                            <thead>
                                <tr>
                                    <th>{{ __('app.title') }}</th>
                                    <th>{{ __('app.location') }}</th>
                                    <th>{{ __('app.category') }}</th>
                                    <th>{{ __('app.start') }}</th>
                                    <th>{{ __('app.end') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <br>
                        <p class="text-center">{{__('iframe-organizer.message-events')}} {{$organizer->organizer_name ??''}}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="row">
            <div class="col-12">
                @isset($organizer->picture_link)
                <div class="card mb-4">
                    <img class="card-img" src="{{$organizer->picture_link}}" alt="Card image">
                </div>
                @endisset
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="font-weight-bold mb-2">{{ __('app.address') }}</p>
                        @if(empty(!$organizer->organizerContactInformation))
                            <table class="event-details-table-sidebar">
                                @if($organizer->organizerContactInformation->address_street)
                                    <tr><td>{{$organizer->organizerContactInformation->address_street ??''}} {{$organizer->organizerContactInformation->address_no ??''}}</td></tr>
                                @endif
                                @if($organizer->organizerContactInformation->address_supplements)
                                    <tr><td>{{$organizer->organizerContactInformation->address_supplements ??''}}</td></tr>
                                @endif
                                @if($organizer->organizerContactInformation->city)
                                <tr><td>{{$organizer->organizerContactInformation->city ??''}} {{$organizer->organizerContactInformation->zip ??''}}</td></tr>
                                @endif
                                <tr><td>@isset($organizer->organizerContactInformation->country)<span class="organizer-country">{{ __('countries.'.$organizer->organizerContactInformation->country)}}</span>@endisset</td></tr>
                            </table>
                        @endif
                        <p class="font-weight-bold mb-2 pt-4">{{ __('app.contact') }}</p>
                        <table class="event-details-table-sidebar">
                            @foreach($organizer->organizerPhoneNumbers as $number)
                                <tr><td>{{$number->country_code ??''}} {{$number->phone_number ??''}} <i>({{$number->type_of_phone_name ??''}})</i></td></tr>
                            @endforeach
                            <tr><td><a href="mailto:{{$organizer->organizer_email ??''}}">{{$organizer->organizer_email ??''}}</a></td></tr>
                            <tr><td><a href="https://{{$organizer->organizer_website ??''}}" target="_blank">{{$organizer->organizer_website ??''}}</a></td></tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <pre>
    @php //print_r($organizer); @endphp
    </pre>
</div>
@endsection
