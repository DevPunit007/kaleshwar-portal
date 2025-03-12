@extends('pages.iframe.user-account--frame')

@section('user-account')

<div class="col-md-9 p-0">
    <div class="user-account-section p-0">
        <div class="card-body">

            @include('pages.user.form-partials.form-user-files')

        </div>
    </div>
</div>

@endsection
