@extends('templates.default')

@section('content')
<div id="register-page" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">
                        <span>{{ __('Register') }}</span>
                        <span class="float-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-brand dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">{{ Config::get('app.locale') }}</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 33px, 0px);">
                                    @foreach($languages as $language)
                                        <a class="dropdown-item" href="{{route('add-register', $language->language_code)}}">{{__('login.language.' . $language->language_code)}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </span>
                    </div>
                    <form method="POST" action="{{ route('register', app()->getLocale()) }}">@csrf
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label for="first-name">First name *</label>
                                <input required id="first_name" name="first_name" type="text" maxlength="190" value="{{ old('first_name') }}" placeholder="Enter your first name" class="form-control">
                                @error('first_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label for="last-name">Last name *</label>
                                <input required id="last_name" name="last_name" type="text" maxlength="190" value="{{ old('last_name') }}" placeholder="Enter your last name" class="form-control">
                                @error('last_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label for="email">{{ __('E-Mail Address') }} *</label>
                                <input required id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="off" placeholder="Enter email" class="form-control @error('email') is-invalid @enderror">
                                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="password">{{ __('Password') }} *</label>
                                <input required id="password" name="password" type="password" minlength="8" autocomplete="password" placeholder="Enter password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @else <small id="password_help" class="form-text text-muted">The password needs to be at least 6 characters.</small> @enderror
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="password-confirm">{{ __('Confirm Password') }}*</label>
                                <input required id="password-confirm" name="password_confirmation" type="password" minlength="8" autocomplete="password" placeholder="Confirm password" class="form-control">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="newsletter" class="checkbox checkbox-dark">
                                    <input id="newsletter" name="newsletter" type="checkbox">
                                    <span>I want to subscribe to the newsletter</span>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="language_code" value="{{ Config::get('app.locale') }}">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
