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

You’ll receive further information after your booking get confirmed.
