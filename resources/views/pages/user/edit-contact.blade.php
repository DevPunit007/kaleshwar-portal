@extends('pages.user.edit--frame')

@section('user-account')

<div class="col-md-9 p-0">
    <div class="user-account-section p-0">
        <form id="contact-information-form" class="enable-able-form" action="{{ route('edit-user-contact', ['language' => app()->getLocale(), 'id' => $user->id]) }}" method="post"> @csrf
            <div class="button-bar">
                <button type="button" class="btn btn-outline-secondary edit-button">Edit</button>
                <button disabled hidden type="submit" class="btn btn-outline-success submit-button">Save</button>
            </div>
            <div class="card-body">

                @include('pages.user.form-partials.form-user-contact')

            </div>
        </form>
    </div>
</div>

@endsection
