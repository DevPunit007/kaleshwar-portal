@extends('templates.default')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4>{{__('start.header')}}</h4>
            <br/>
            @if (auth()->user()->rule_id == 3)
                {!! __('start.bodytext') !!}
            @else
                <p>We have extended the Ashram portal with new functions to edit your bookings.</p>
                <p>In your booking of online events you can only edit your booking message and for bookings where you travel to the Ashram you can add or edit your travel details and other registration data.</p>
                <p>Please click in the menu at "Bookings" and then click at the booking you like to edit.</p>
            @endif
        </div>
    </div>
</div>
<pre>
    @php //print_r($events); @endphp
</pre>
@endsection
