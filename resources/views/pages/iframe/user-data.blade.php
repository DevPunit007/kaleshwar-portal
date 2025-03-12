@extends('templates.iframe')

@section('content')
<div class="row iframe-view">
    <div class="col-md-8 col-sm-12">
        <div class="row event-details">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-header">
                        Complete your user account
                    </div>
                    <div class="card-body">

                        <form method="post" action="{{}}" enctype="multipart/form-data">@csrf

                            <h5 class="card-subtitle">Basic information</h5>
                            <p>Please fill out the following fields with your personal information to complete your user account.</p>
                            <div class="col-md-12 form-group mb-3">
                                <label for="last-name">Last name *</label>
                                <input required id="last_name" name="last_name" type="text" maxlength="190" value="{{ old('last_name') }}" placeholder="Enter your last name" class="form-control">
                                @error('last_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>

                            <h5 class="card-subtitle">Contact information</h5>
                            <p>Please fill out the following fields with your personal information to complete your user account.</p>
                            <div class="col-md-12 form-group mb-3">
                                <label for="last-name">Last name *</label>
                                <input required id="last_name" name="last_name" type="text" maxlength="190" value="{{ old('last_name') }}" placeholder="Enter your last name" class="form-control">
                                @error('last_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>

                            <div class="mt-4 mb-3">
                                <button class="btn btn-outline-primary" type="submit">Confirm and Save your user data</button>
{{--                                <a class="btn btn-outline-dark mx-2" href="{{ route('iframe-details', ['language' => app()->getLocale(), 'id' => $event->id]) }}">Back</a>--}}
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
                    <img class="card-img" src="/images/events/ashram_mandir_2-300.jpg" alt="Card image">
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        Event details
                    </div>
                    <div class="card-body">
                        <table class="event-details-table-sidebar">
                            @if($event->has_date)
                                @if($event->start_date)
                                    <tr><td>{{ __('iframe-events.start-date') }}:</td><td>{{$event->start_date ? date_format(date_create($event->start_date), "d M Y") : ''}}</td></tr>
                                    <tr><td>{{ __('iframe-events.end-date') }}:</td><td>{{$event->end_date ? date_format(date_create($event->end_date), "d M Y") : ''}}</td></tr>
                                @else
                                    <tr><td>{{__('iframe-user-account.date')}}:</td><td>{{$event->end_date ? date_format(date_create($event->end_date), "d M Y") : ''}}</td></tr>
                                @endif
                            @endif
                            <tr><td>Organizer:</td><td>{{$event->organizer->organizer_name}}</td></tr>
                            <tr><td>Contact:</td><td>{{$event->userInformation->first_name}} {{$event->userInformation->last_name}} <a data-toggle="modal" data-target="#modal_message"><i class="far fa-envelope" data-toggle="tooltip" title="Click here to send a message to the contact"></i></a></td></tr>
                            <tr><td>Location:</td><td>{{$event->locationDetails->name}}{{$event->locationDetails->country ? ', ' . $event->locationDetails->country : ''}}  <i class="far fa-info-circle" data-toggle="tooltip" title="You get full address with the booking confirmation"></i></td></tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('partials.modal_message')

    <pre>
    @php //print_r($event); @endphp
    </pre>
</div>
@endsection

