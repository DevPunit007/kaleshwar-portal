@extends('pages.iframe.user-account--frame')

@section('user-account')

<div class="col-md-9 p-0">
    <div class="user-account-section p-0">
        <div class="card-body">
            <p>Hello {{$user->first_name ??''}} {{$user->last_name ??''}},</p>
            <p>we have extended the Ashram portal with new functions to edit your bookings.</p>
            <p>In your booking of online events you can only edit your booking message but for bookings where you travel to the Ashram you can add or edit your travel details and other registration data.</p>
            <p>Please click in the left sidebar the menu item: "Ashram portal".</p>
        </div>
    </div>
</div>

@endsection
