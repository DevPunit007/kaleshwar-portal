@extends('emails.templates.default')

@section('content')

    <h2>Hello {{$user->first_name}} {{$user->last_name}},</h2>
    <p>you successfully booked the following event:</p>

    <table class="panel" width="90%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td class="panel-content">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="panel-item">
                            <table class="table">
                                <tr><td colspan="2"><strong>{{$eventDetail->title}}</strong></td></tr>
                                <tr><td>Selection:</td><td>{{$booking->EventSectionDetailLanguage->title ??'(missing translation)'}}</td></tr>
                                <tr><td>Ticket:</td><td>{{$booking->id}}</td></tr>
                                @if($event->has_date)
                                    @if($event->start_date)
                                        <tr><td>{{ __('iframe-events.start-date') }}:</td><td>{{$event->start_date ? date_format(date_create($event->start_date), "d M Y") : ''}}</td></tr>
                                        <tr><td>{{ __('iframe-events.end-date') }}:</td><td>{{$event->end_date ? date_format(date_create($event->end_date), "d M Y") : ''}}</td></tr>
                                    @else
                                        <tr><td>{{__('iframe-user-account.date')}}:</td><td>{{$event->end_date ? date_format(date_create($event->end_date), "d M Y") : ''}}</td></tr>
                                    @endif
                                @endif
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    @if(empty($eventDetail->after_booking))
        <p>You’ll receive further information before the event starts.</p>
    @else
        <p>{!! $eventDetail->after_booking !!}</p>
    @endif

    @if($booking->event_section_price > 0)
        <hr>
        <p>If you haven’t done your payment yet, please use any of the following payment options:</p>
        <h3>Wire Transfer from your local Bank</h3>
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
                <td>Purpose:</td><td>Ticket #{{$booking->id}}</td>
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
        <p>Please click at the PayPal button to pay the program fee with your PayPal account or your credit card:</p>
        <p><a
            @switch($booking->currency)
                @case('1') href="https://www.paypal.com/donate?hosted_button_id=P64M655H6AAY2" target="_blank" title="PayPal button for event payment in USD" @break
                @case('2') href="https://www.paypal.com/donate?hosted_button_id=UQCPUH2PTWU2E" target="_blank" title="PayPal button for event payment in EUR" @break
            @endswitch >
            <img src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" alt="PayPal - The safer, easier way to pay online!">
        </a></p>

        <p>At the Paypal form please enter the amount of <b>
                        @switch($booking->currency)
                    @case('1') $ {{$booking->event_section_price ??''}} @break
                    @case('2') {{$booking->event_section_price ??''}} € @break
                @endswitch </b>
            and following purpose/note: <b>"Ticket #{{$booking->id}}"</b>.</p>
    @endif
    <table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td>
                {{--General information by the ashram --}}
            </td>
        </tr>
    </table>
@endsection
