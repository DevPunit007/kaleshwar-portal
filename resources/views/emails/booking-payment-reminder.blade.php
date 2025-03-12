@extends('emails.templates.default')

@section('content')

    <h2>Hello {{$user->first_name}} {{$user->last_name}},</h2>
    <p>we would like to remind you of the outstanding payment for the following event:</p>

    <table class="panel" width="90%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td class="panel-content">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="panel-item">
                            <table class="table">
                                <tr><td colspan="2"><strong>{{$eventDetail->title}}</strong></td></tr>
                                <tr><td>Ticket:</td><td>{{$booking->id}}</td></tr>
                                @if($event->has_date)
                                    @if($event->start_date)
                                        <tr><td>{{ __('iframe-events.start-date') }}:</td><td>{{$event->start_date ? date_format(date_create($event->start_date), "d M Y") : ''}}</td></tr>
                                        <tr><td>{{ __('iframe-events.end-date') }}:</td><td>{{$event->end_date ? date_format(date_create($event->end_date), "d M Y") : ''}}</td></tr>
                                    @else
                                        <tr><td>{{__('iframe-user-account.date')}}:</td><td>{{$event->end_date ? date_format(date_create($event->end_date), "d M Y") : ''}}</td></tr>
                                    @endif
                                @endif
                                <tr><td>Amount:</td><td><span class="font-weight-bold">
                                        @switch($booking->currency)
                                                                    @case('1') $ {{$booking->event_section_price ??''}} @break
                                                                    @case('2') {{$booking->event_section_price ??''}} € @break
                                                                @endswitch
                                    </span></td></tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <p>If you have done your payment already then please let us know when you send your payment and which payment way you chosen.</p>
    <p>Otherwise use any of the following payment options:</p>
    <h3>Wire Transfer from your local Bank</h3>
    <hr>
    <p>Please use the following information for the payment:</p>
    <table class="table-payment">
        <tr>
            <td>Account holder:</td><td>Shirdi Sai Global Trust</td>
        </tr><tr>
            <td>Bank:</td><td>GLS Bank Bochum, Germany</td>
        </tr><tr>
            <td>IBAN:</td><td>DE32 4306 0967 4081 5482 00</td>
        </tr><tr>
            <td>BIC/SWIFT Code:</td><td>GENODEM1GLS</td>
        </tr><tr>
            <td>Purpose:</td><td>Mother Divine program fee #{{$booking->id}}</td>
        </tr>
        <tr>
            <td>Amount:</td><td><span class="font-weight-bold">
                    @switch($booking->currency)
                        @case('1') $ {{$booking->event_section_price ??''}} @break
                        @case('2') {{$booking->event_section_price ??''}} € @break
                    @endswitch
                </span></td>
        </tr>
    </table>
    <h3>Online payment with PayPal</h3>
    <hr>
    <p>Please click at the "Pay Now" button to pay the program fee with your PayPal account or your credit card:</p>

    <a href="https://paypal.me/shirdisaiglobaltrust?locale.x=en_US">
        <img src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" alt="PayPal - The safer, easier way to pay online!">
    </a>

@endsection
