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
                                <h5 class="backend-title mt-2">Add new translation for {{$organizer->organizer_name}}</h5>
                            </div>
                            <div class="col-auto text-right">
                                <button onclick="window.location.href = '{{ route($organizer->type . '-edit', ['language' => app()->getLocale(), 'id' => $organizer->id]) }}';" type="button" class="btn btn-outline-dark btn-header">Back</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{ route('organizer-add-translation', ['language' => app()->getLocale(), 'id' => $organizer->id]) }}">@csrf
                            <div class="form-group">
                                <label for="organizer-language">Language</label>
                                <select name="organizer_language" id="organizer-language" class="custom-select col-lg-6 col-sm-12">
                                    @foreach($languages as $language)
                                        <option value="{{$language}}">{{__('login.language.' . $language)}}</option>
                                    @endforeach
                                </select>
                            </div>
{{--                            <div class="form-row">--}}
{{--                                <div class="form-group col-lg-12">--}}
{{--                                    <label for="introduction">Introduction *</label>--}}
{{--                                    <textarea id="introduction" name="introduction" class="form-control" rows="2" maxlength="130" required></textarea>--}}
{{--                                    @error('introduction')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control add_tinymce" rows="5"></textarea>
                                    @error('description')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
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
