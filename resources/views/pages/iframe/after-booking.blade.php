@extends('templates.iframe')

@section('content')
    <div class="card">
        <div class="card-body">
            @if($status === 'success')
                <div class="alert alert-success" role="alert">
                    {{ __('iframe-events.success-message-part1') }} <strong>{{$event->EventDetailLanguage->title}}</strong> {{ __('iframe-events.success-message-part2') }} {{$booking->EventSectionDetailLanguage->title ??'(missing translation)'}}. <br>{{ __('iframe-events.success-message-part3') }}: <strong>{{$booking->id}}</strong>
                </div>
                @if(empty($event->EventDetailLanguage->after_booking))
                    <p>{{ __('iframe-events.event-instructions') }}.</p>
                @else
                    <p>{!! $event->EventDetailLanguage->after_booking !!}</p>
                @endif

                @if($booking->event_section_price > 0)
                    <hr>
                    <p>{{ __('iframe-events.payment-options') }}:</p>

                    <h5 class="mt-4">Wire Transfer from your local Bank</h5>
                    <p>Please use the following information for the payment:</p>
                        <table>
                            <tr>
                                <td class="px-3">Account holder:</td><td>Shirdi Sai Global Trust</td></tr><tr>
                                <td class="px-3">Bank:</td><td>GLS Bank Bochum, Christstr. 9, 44789 Bochum</td></tr><tr>
                                <td class="px-3">IBAN:</td><td>DE32 4306 0967 4081 5482 00</td></tr><tr>
                                <td class="px-3">BIC / SWIFT Code:</td><td>GENODEM1GLS</td></tr><tr>
                                <td class="px-3">Purpose:</td><td>Ticket #{{$booking->id}}</td>
                            </tr>
                            <tr>
                                <td class="px-3">Amount:</td><td><span class="font-weight-bold">
                                    @switch($booking->currency)
                                        @case('1') $ {{$booking->event_section_price ??''}} @break
                                        @case('2') {{$booking->event_section_price ??''}} € @break
                                    @endswitch
                                </span></td>
                            </tr>
                        </table>
                    <h5 class="mt-4">Online payment with PayPal</h5>
                    <p>Please click at the PayPal button to pay the program fee with your PayPal account or your credit card:</p>
                    <p><a
                        @switch($booking->currency)
                            @case('1') href="https://www.paypal.com/donate?hosted_button_id=P64M655H6AAY2" target="_blank" title="PayPal button for event payment in USD" @break
                            @case('2') href="https://www.paypal.com/donate?hosted_button_id=UQCPUH2PTWU2E" target="_blank" title="PayPal button for event payment in EUR" @break
                        @endswitch >
                        <img src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" alt="PayPal - The safer, easier way to pay online!">
                    </a></p>
                    <p>At the Paypal form please enter the amount of <span class="font-weight-bold">
                        @switch($booking->currency)
                            @case('1') $ {{$booking->event_section_price ??''}} @break
                            @case('2') {{$booking->event_section_price ??''}} € @break
                        @endswitch </span>
                    and following purpose/note: <span class="font-weight-bold">"Ticket #{{$booking->id}}"</span>.</p>
                @endif

            @else
                Event booking failed.
            @endif
            <hr>
            <div class="form-group row mb-0">
                <div class="col-md-6">
                    <a type="button" href="{{ route('iframe-booking', ['language' => app()->getLocale(), 'id' => $event->id]) }}" class="btn btn-outline-primary mx-2">
                        Back to the event
                    </a>
                    <a type="button" href="{{ route('iframe-user-account-basic', app()->getLocale()) }}" class="btn btn-secondary mx-2">
                        {{ __('Back to user account') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
