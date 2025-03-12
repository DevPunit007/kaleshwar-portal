@extends('pages.iframe.user-account--frame')

@section('user-account')

<div class="col-md-9 p-0">
    <div class="user-account-section p-0">
        <form class="enable-able-form" action="{{ route('edit-user-contact', ['language' => app()->getLocale(), 'id' => $user->id]) }}" method="post"> @csrf
            <div class="card-body">

                @include('pages.user.form-partials.form-user-contact')

                {{-- Button Edit and Save for User Frontend --}}
                <div class="form-row pb-0 mt-2">
                    <div class="form-group">
                        <button type="button" class="btn btn-dark edit-button">Edit</button>
                        <button disabled hidden type="submit" class="btn btn-primary submit-button">Save</button>
                    </div>
                    {{--<div class="form-group">
                        <label class="color-gray">* These fields are required</label>
                    </div>--}}
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
