@extends('templates.default')

@section('content')
    <div class="add-event-translation container">
        <div class="card rounded-0">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <button onclick="window.history.back();" type="button" class="btn btn-outline-dark">Back</button>
                </div>
                <form method="post" action="{{ route('event-section-add-translation', ['language' => app()->getLocale(), 'id' => $eventSection->id]) }}">@csrf
                    <div class="form-group row">
                        <label for="language" class="col-sm-2 col-form-label">Language</label>
                        <div class="col-sm-4">
                            <select name="language" id="language" class="custom-select">
                                @foreach($languages as $language)
                                    <option value="{{$language}}">{{__('login.language.' . $language)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input id="title" name="title" class="form-control" maxlength="190">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input id="description" name="description" class="form-control" maxlength="190">
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn w-50 text-light mt-3 color-brand-blue" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
