Hello {{$user->first_name}} {{$user->last_name}},
you successfully booked the following event:

{{$eventDetail->title}}
--------------------------------------
Ticket:  {{$booking->id}}
@if($event->has_date)
@if($event->start_date)
{{ __('iframe-events.start-date') }}:  {{$event->start_date ? date_format(date_create($event->start_date), "d M Y") : ''}}
{{ __('iframe-events.end-date') }}:  {{$event->end_date ? date_format(date_create($event->end_date), "d M Y") : ''}}
@else
{{__('iframe-user-account.date')}}:  {{$event->end_date ? date_format(date_create($event->end_date), "d M Y") : ''}}
@endif
@endif

You’ll receive further information before the event starts.

If you haven’t done your payment yet, please use any of the following payment options:


Wire Transfer from your local Bank
--------------------------------------
Please use the following information for the payment:

Account holder:  Shirdi Sai Global Trust
Bank:  GLS Bank Bochum, Germany
IBAN:  DE32 4306 0967 4081 5482 00
BIC/SWIFT Code:  GENODEM1GLS

Purpose:Mother Divine program fee #{{$booking->id}}

Amount: @switch($booking->currency) @case('1') $ {{$booking->eventSection->price_usd ??''}} @break @case('2') {{$booking->eventSection->price_euro ??''}} € @break @endswitch


Online payment with PayPal
--------------------------------------

Please click at the "Pay Now" button to pay the program fee with your PayPal account or your credit card:

@switch($booking->currency) @case('1') https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=GD8WJPMEQ9ZTJ @break@case('2') https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=KFT752FKNARVA @break @endswitch
