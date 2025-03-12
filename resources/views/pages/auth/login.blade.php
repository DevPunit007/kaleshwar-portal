@extends('templates.iframe')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">
                        <span>{{ __('login.login-title') }}</span>
                    </div>
                    <form method="POST" action="{{ route('login', app()->getLocale()) }}" novalidate>@csrf
                        <div class="form-row">
                            <div class="col-md-12 form-group px-1 mb-3">
                                <label for="email">{{ __('login.email') }}</label>
                                <input required id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{ __('login.email-placeholder') }}" class="form-control @error('email') is-invalid @enderror">
                                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="col-md-12 form-group px-1 mb-3">
                                <label for="password">{{ __('login.password') }}</label>
                                <input required id="password" name="password" type="password" value="{{ old('email') }}" autocomplete="current-password" placeholder="{{ __('login.password-placeholder') }}" class="form-control @error('password') is-invalid @enderror">
                                @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="col-md-12">
                                {!! __('login.note') !!}
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="mr-4">
                                <button type="submit" class="btn btn-primary">{{ __('login.login') }}</button>
                            </div>
                            {{--<div class="mt-2">
                                <label for="remember" class="checkbox checkbox-dark">
                                    <input id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                    <span>{{ __('login.remember_me') }}</span>
                                    <span class="checkmark"></span>
                                </label>
                            </div>--}}

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            @if (Route::has('password.request'))
                <p class="mb-2">{{ __('login.forgot-text') }} <a class="btn-link" target="_parent" href="{{ route('password.request', app()->getLocale()) }}">{{ __('login.forgot-link') }}</a></p>
            @endif
            <p class="mb-2">{{ __('login.reactivate-text') }} <a class="btn-link" target="_parent" href="{{ route('password.reactivate', app()->getLocale()) }}">{{ __('login.reactivate-link') }}</a></p>
            <p class="mb-2">{{ __('login.register-text') }} <a class="btn-link" target="_parent" href="https://srikaleshwar.world/en/user/registration">{{ __('login.register-link') }}</a></p>
        </div>
    </div>
</div>
@endsection
