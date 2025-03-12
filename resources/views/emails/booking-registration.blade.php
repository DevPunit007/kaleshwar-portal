@extends('emails.templates.default')

@section('content')

    <h2>Hello {{$user->first_name}} {{$user->last_name}},</h2>
    <p>we received your registration for the following event:</p>

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

    <p>For any questions or requests about your registration please let us know your ticket number.</p>
    <p>If you have not yet filled out all the information for your stay, you can add or change your information at any time using the following link:<br><a href="https://portal.srikaleshwar.world/en/booking/user-edit/{{$booking->id}}">Registration form for your booking</a></p>
    <p>We will review your registration and send you a booking confirmation in the next days. Please wait for your final travel arrangements till you received the confirmation.
        You will receive further program details a few days before the program starts.</p>

    <table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td>
                {{--General information by the ashram --}}
            </td>
        </tr>
    </table>
@endsection
