@extends('templates.iframe')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="row iframe-view">
	<div class="col-12">
		<div class="card rounded mb-5">
			<div class="card-header">
				<div class="row">
					<div class="col mr-auto">
						<h5 class="backend-title mt-2">{{ __('iframe-user-account.user-account') }} :: {{$user->first_name ??''}} {{$user->last_name ??''}}</h5>
					</div>
				</div>
			</div>
			<div class="row m-0">
                <div class="col-md-3 p-0">
                    <div class="card-body px-0 py-4">
                        <div class="nav flex-column nav-pills text-center text-md-left" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link" id="user-account-welcome" href="{{ route('iframe-user-welcome', app()->getLocale()) }}">Welcome</a>

                            <a class="nav-link mt-4" id="user-account-basic" href="{{ route('iframe-user-account-basic', ['language' => app()->getLocale()]) }}">{{__('iframe-user-account.basic-info')}}</a>
                            <a class="nav-link" id="user-account-contact" href="{{ route('iframe-user-account-contact', ['language' => app()->getLocale()]) }}">{{__('iframe-user-account.contact-info')}}</a>
                            <a class="nav-link" id="user-account-personal" href="{{ route('iframe-user-account-personal', ['language' => app()->getLocale()]) }}">{{__('iframe-user-account.personal-info')}}</a>
                            <a class="nav-link" id="user-account-spiritual" href="{{ route('iframe-user-account-spiritual', ['language' => app()->getLocale()]) }}">{{__('iframe-user-account.spiritual-history')}}</a>
                            <a class="nav-link" id="user-account-additional" href="{{ route('iframe-user-account-additional', ['language' => app()->getLocale()]) }}">{{__('iframe-user-account.additional-data')}}</a>

                            <a class="nav-link mt-4" id="user-account-files" href="{{ route('iframe-user-files', app()->getLocale()) }}">{{__('iframe-user-account.media-center')}}</a>

                            @if(auth()->user()['rule_id'] > 1) <a class="nav-link mt-4" id="admin-console-tab" href="{{ route('home', app()->getLocale()) }}" target="_parent" role="link">{{__('iframe-user-account.ashram-portal')}}</a> @endif

                            <a class="nav-link mt-4" id="user-logout" href="{{ route('iframe-user-logout', app()->getLocale()) }}">{{__('iframe-user-account.logout')}}</a>
                        </div>
                    </div>
                </div>

                @yield('user-account')

			</div>
		</div>
	</div>
</div>

<script>
    $(function() {
        let path_name = location.pathname.substring(location.pathname.lastIndexOf('/') + 1);
        $('.nav a[id="' + path_name + '"]').addClass('active');
    });
</script>

@endsection
