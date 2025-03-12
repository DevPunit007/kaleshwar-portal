@extends('pages.user.edit--frame')

@section('user-account')

<div class="col-md-9 p-0">
    <div class="user-account-section p-0">
        <form class="enable-able-form" method="post" action="{{ route('edit-user-basic', ['language' => app()->getLocale(), 'id' => $user->id]) }}" enctype="multipart/form-data">@csrf
            <div class="button-bar">
                <button type="button" class="btn btn-outline-secondary edit-button">Edit</button>
                <button disabled hidden type="submit" class="btn btn-outline-success submit-button">Save</button>
            </div>
            <div class="card-body">

                @include('pages.user.form-partials.form-user-basic')

                <div class="form-row pb-0 mt-2">
                    <div class="form-group">
                        <label class="color-gray">* These fields are required</label>
                    </div>
                </div>
                @if(auth()->user()->id == 8003 || auth()->user()->id == 4958)
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="password">{{ __('login.password') }} *</label>
                            <input name="password" type="text" class="form-control" id="password" value="" minlength="8" maxlength="16" placeholder="enter here new password only in special cases" disabled>
                        </div>
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>

@endsection
