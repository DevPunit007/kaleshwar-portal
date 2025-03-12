@extends('emails.templates.default')

@section('content')

    <h2>Hello {{$user->first_name}} {{$user->last_name}},</h2>
    <p>we received your payment for the following event:</p>

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
                                <tr><td>Amount:</td><td>@switch($booking->currency)
                                            @case('1') $ {{$booking->event_section_price ??''}} @break
                                            @case('2') {{$booking->event_section_price ??''}} € @break
                                        @endswitch</td></tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <p>We are very happy that you are participating in the event and we will send you further information before the event starts.</p>
    <p>If you have any questions please send us a message.</p>
    <hr>
    <p>That message is the payment receipt for your booking and contains all needed information for your tax declaration.</p>
    <h2>Issued for:</h2>
    <p>{{$user->first_name}} {{$user->last_name}}, {{$user->contactInformation->address_street ??''}} {{$user->contactInformation->address_no ??''}}, {{$user->contactInformation->city ??''}} {{$user->contactInformation->zip ??''}}, {{$user->contactInformation->country ??''}}</p>
    <h2>Issued by:</h2>
    <p>Shirdi Sai Global Trust, Shiva Sai Mandir, Penukonda 515110, Anantapur District, A.P., India</p>

    <p class="sub">Shirdi Sai Global Trust is a non-EU organization with no VAT registration. <br>VAT was not applied to this receipt.</p>
@endsection
