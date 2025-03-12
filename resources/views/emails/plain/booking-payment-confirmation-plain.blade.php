Hello {{$user->first_name}} {{$user->last_name}},
we received your payment for the following event:

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
Amount: @switch($booking->currency) @case('1') $ {{$booking->event_section_price ??''}} @break @case('2') {{$booking->event_section_price ??''}} € @break @endswitch


We are very happy that you are participating in the event and we will send you further information before the event starts.
If you have any questions please send us a message.
