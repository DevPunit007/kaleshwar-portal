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
                                <h5 class="backend-title mt-2">Edit Section {{$eventSection->eventSectionDetails[0]->title}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col-md-3 p-0">
                            <div class="card-body px-0 py-4">
                                <div class="nav flex-column nav-pills text-center text-md-left" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active show" id="basic-data-tab" data-toggle="tab" href="#basic-data-Form" role="tab" aria-controls="basic-data-Tab" aria-selected="true">Section Basic Data</a>
                                    @foreach($eventSection->eventSectionDetails as $eventSectionDetail)
                                        <a class="nav-link" id="{{$eventSectionDetail->language}}-tab" data-toggle="tab" href="#{{$eventSectionDetail->language}}Form" role="tab" aria-controls="{{$eventSectionDetail->language}}Tab" aria-selected="true">Details: {{__('login.language.' . $eventSectionDetail->language)}}</a>
                                    @endforeach
                                    <a class="nav-link" href="{{route('event-section-add-translation', ['language' => app()->getLocale(), 'id' => $eventSection->id]) }}">Add Translation</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 p-0">
                            <div class="user-account-section p-0">
                                <div class="tab-content p-0" id="myTabContent">
                                    <div class="tab-pane fade active show" id="basic-data-Form" role="tabpanel" aria-labelledby="basic-data-tab">
                                        <div class="card-body">
                                            <form id="edit-event-basic-form" class="enable-able-form" action="{{ route('event-section-edit', ['language' => app()->getLocale(), 'id' => $eventSection->id]) }}" method="post">@csrf
                                                <div class="button-bar">
                                                    <button type="button" class="btn btn-outline-secondary edit-button">Edit</button>
                                                    <button disabled hidden type="submit" class="btn btn-outline-success submit-button">Save</button>
                                                    <button onclick="window.location.href = '{{ route('event-edit', ['language' => app()->getLocale(), 'id' => $eventSection->event_id]) }}';" type="button" class="btn btn-outline-dark">Back</button>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-6">
                                                        <label for="price-usd">Price USD</label>
                                                        <input disabled id="price-usd" name="price_usd" class="form-control" value="{{$eventSection->price_usd}}">
                                                        @error('price_usd')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="price-euro">Price Euro</label>
                                                        <input disabled id="price-euro" name="price_euro" class="form-control" value="{{$eventSection->price_euro}}">
                                                        @error('price_euro')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-3">
                                                        <div class="form-check">
                                                            <input disabled class="form-check-input" type="checkbox" id="is_visible" name="is_visible" {{ $eventSection->is_visible !== 0 ? 'checked' : ''}}>
                                                            <label class="form-check-label" for="is_visible">
                                                                Is visible
                                                            </label>
                                                        </div>
                                                        @error('is_visible')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                    <div class="form-group col-lg-3">
                                                        <div class="form-check">
                                                            <input disabled class="form-check-input" type="checkbox" id="has_registration" name="has_registration" {{ $eventSection->has_registration !== 0 ? 'checked' : ''}}>
                                                            <label class="form-check-label" for="has_registration">
                                                                Has registration
                                                            </label>
                                                        </div>
                                                        @error('has_registration')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                    <div class="form-group col-lg-3">
                                                        <div class="form-check">
                                                            <input disabled class="form-check-input" type="checkbox" id="is_topic" name="is_topic" {{ $eventSection->is_topic !== 0 ? 'checked' : ''}}>
                                                            <label class="form-check-label" for="is_topic">
                                                                Is topic
                                                            </label>
                                                        </div>
                                                        @error('is_topic')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                    <div class="form-group col-lg-3">
                                                        <div class="form-check">
                                                            <input disabled class="form-check-input" type="checkbox" id="is_bookable" name="is_bookable" {{ $eventSection->is_bookable !== 0 ? 'checked' : ''}}>
                                                            <label class="form-check-label" for="is_bookable">
                                                                Is bookable
                                                            </label>
                                                        </div>
                                                        @error('is_bookable')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
{{--                                                    <div class="form-group col-lg-3">--}}
{{--                                                        <div class="form-check">--}}
{{--                                                            <input disabled class="form-check-input" type="checkbox" id="is_discounted" name="is_discounted" {{ $eventSection->is_discounted !== 0 ? 'checked' : ''}}>--}}
{{--                                                            <label class="form-check-label" for="is_discounted">--}}
{{--                                                                Is discounted--}}
{{--                                                            </label>--}}
{{--                                                        </div>--}}
{{--                                                        @error('is_discounted')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--                                                    </div>--}}
                                                </div>
{{--                                                <div class="form-row">--}}
{{--                                                    <div class="form-group col-12">--}}
{{--                                                        <div class="form-check">--}}
{{--                                                            <input disabled class="form-check-input" type="checkbox" id="has_own_date" name="has_own_date" {{ $eventSection->has_own_date !== 0 ? 'checked' : ''}}>--}}
{{--                                                            <label class="form-check-label" for="has_own_date">--}}
{{--                                                                Has own date--}}
{{--                                                            </label>--}}
{{--                                                        </div>--}}
{{--                                                        @error('has_own_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-row">--}}
{{--                                                    <div class="form-group col-lg-6">--}}
{{--                                                        <label for="start-date">Start Date</label>--}}
{{--                                                        <input disabled id="start-date" name="start_date" class="form-control" value="{{$eventSection->start_date}}">--}}
{{--                                                        @error('start_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-group col-lg-6">--}}
{{--                                                        <label for="end-date">End Date</label>--}}
{{--                                                        <input disabled id="end-date" name="end_date" class="form-control" value="{{$eventSection->end_date}}">--}}
{{--                                                        @error('end_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-row">--}}
{{--                                                    <div class="form-group col-lg-6">--}}
{{--                                                        <label for="start-time">Start Time</label>--}}
{{--                                                        <input disabled id="start-time" name="start_time" class="form-control" value="{{$eventSection->start_time}}">--}}
{{--                                                        @error('start_time')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-group col-lg-6">--}}
{{--                                                        <label for="end-time">End Time</label>--}}
{{--                                                        <input disabled id="end-time" name="end_time" class="form-control" value="{{$eventSection->end_time}}">--}}
{{--                                                        @error('end_time')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                            </form>
                                        </div>
                                    </div>

                                    @foreach($eventSection->eventSectionDetails as $eventSectionDetail)
                                        <div class="tab-pane fade" id="{{$eventSectionDetail->language}}Form" role="tabpanel" aria-labelledby="{{$eventSectionDetail->language}}-tab">
                                            <div class="card-body">
                                                <form id="edit-event-form-{{$eventSectionDetail->language}}" class="enable-able-form" action="{{ route('event-section-details-edit', ['language' => app()->getLocale(), 'id' => $eventSectionDetail->id]) }}" method="post">@csrf
                                                    <div class="button-bar">
                                                        <button type="button" class="btn btn-outline-secondary edit-button">Edit</button>
                                                        <button disabled hidden type="submit" class="btn btn-outline-success submit-button">Save</button>
                                                        <button onclick="window.history.back();" type="button" class="btn btn-outline-dark">Back</button>
                                                    </div>
                                                    <input hidden name="language" value="{{$eventSectionDetail->language}}">
                                                    <div class="form-row">
                                                        <div class="form-group col-lg-12">
                                                            <label for="title">Title *</label>
                                                            <input disabled required id="title" name="title" class="form-control" value="{{$eventSectionDetail->title}}" maxlength="190">
                                                            @error('title')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>
                                                        <div class="form-group col-lg-12">
                                                            <label for="description">Description</label>
                                                            <textarea disabled id="description" name="description" class="form-control" rows="2" maxlength="190">{{$eventSectionDetail->description}}</textarea>
                                                            @error('description')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
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
