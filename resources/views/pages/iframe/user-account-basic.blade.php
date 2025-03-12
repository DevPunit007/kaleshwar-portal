@extends('pages.iframe.user-account--frame')

@section('user-account')

<div class="col-md-9 p-0">
    <div class="user-account-section p-0">
        <form class="enable-able-form" method="post" action="{{ route('edit-user-basic', ['language' => app()->getLocale(), 'id' => $user->id]) }}" enctype="multipart/form-data"> @csrf
            <div class="card-body">

                @include('pages.user.form-partials.form-user-basic')

                {{-- Button Edit and Save for User Frontend --}}
                <div class="form-row pb-0 mt-2">
                    <div class="form-group">
                        <button type="button" class="btn btn-dark edit-button">{{__('iframe-user-account.edit')}}</button>
                        <button disabled hidden type="submit" class="btn btn-primary submit-button">{{__('iframe-user-account.save')}}</button>
                    </div>
                    <div class="form-group">
                        <label class="color-gray">* {{__('iframe-user-account.field_required')}}</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
