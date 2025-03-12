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
                            <h5 class="backend-title mt-2">Add Section</h5>
                        </div>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-md-12 p-0">
                        <div class="card-body">
                            <form id="edit-event-basic-form" class="enable-able-form" action="{{ route('event-section-add', ['language' => app()->getLocale(), 'id' => $eventId]) }}" method="post">@csrf
                                <div class="button-bar">
                                    <button type="submit" class="btn btn-outline-success submit-button">Save</button>
                                    <button onclick="window.history.back();" type="button" class="btn btn-outline-dark">Back</button>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <label for="price-usd">Price USD</label>
                                        <input id="price-usd" name="price_usd" class="form-control" value="">
                                        @error('price_usd')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="price-euro">Price Euro</label>
                                        <input id="price-euro" name="price_euro" class="form-control" value="">
                                        @error('price_euro')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_visible" name="is_visible" checked>
                                            <label class="form-check-label" for="is_visible">
                                                Is visible
                                            </label>
                                        </div>
                                        @error('is_visible')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="has_registration" name="has_registration">
                                            <label class="form-check-label" for="has_registration">
                                                Has registration
                                            </label>
                                        </div>
                                        @error('has_registration')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_bookable" name="is_bookable" checked>
                                            <label class="form-check-label" for="is_bookable">
                                                Is bookable
                                            </label>
                                        </div>
                                        @error('is_bookable')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_topic" name="is_topic">
                                            <label class="form-check-label" for="is_topic">
                                                Is topic
                                            </label>
                                        </div>
                                        @error('is_topic')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>

{{--                                    <div class="form-group col-lg-3">--}}
{{--                                        <div class="form-check">--}}
{{--                                            <input class="form-check-input" type="checkbox" id="is_discounted" name="is_discounted">--}}
{{--                                            <label class="form-check-label" for="is_discounted">--}}
{{--                                                Is discounted--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        @error('is_discounted')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--                                    </div>--}}
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="language" class="col-sm-2 col-form-label">Language</label>
                                    <div class="col-sm-4">
                                        <select name="language" id="language" class="custom-select">
                                            @foreach($languages as $language)
                                                <option value="{{$language->language_code}}">{{__('login.language.' . $language->language_code)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 col-form-label">Title *</label>
                                    <div class="col-sm-10">
                                        <input id="title" name="title" class="form-control" maxlength="190" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <input id="description" name="description" class="form-control" maxlength="190">
                                    </div>
                                </div>
                            </form>
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
