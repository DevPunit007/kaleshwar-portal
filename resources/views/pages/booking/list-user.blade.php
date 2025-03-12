@extends('templates.default')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col mr-auto">
                    <h5 class="backend-title mt-2">
                        Bookings :: {{$user->first_name ??''}} {{$user->last_name ??''}}
                    </h5>
                </div>
{{--                <div class="col-auto text-right">--}}
{{--                    <button onclick="alert('is coming soon');" type="button" class="btn btn-outline-success btn-header">Test</button>--}}
{{--                </div>--}}
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover display" id="default-desc-list-table">
                    <thead>
                        <tr>
                            <th class="border-top-0">{{ __('iframe-user-account.ticket') }}</th>
                            <th class="border-top-0 nowrap">{{ __('iframe-user-account.booking-at') }}</th>
                            <th class="border-top-0">{{ __('iframe-user-account.program') }}</th>
                            <th class="border-top-0">{{ __('iframe-user-account.price') }}</th>
                            <th class="border-top-0">{{ __('iframe-user-account.start-date') }}</th>
                            <th class="select-filter-row">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $booking)
                        <tr @if($booking->id < 40000) class="text-muted" @else onclick="window.location.href = '{{ route('booking-user-edit', ['language' => app()->getLocale(), 'id' => $booking->id]) }}';" @endif>
                            <td>@if($booking->id > 40000) <a href="{{ route('booking-user-edit', ['language' => app()->getLocale(), 'id' => $booking->id]) }}">{{$booking->id}}</a> @endif</td>
                            <td class="nowrap">{{$booking->created_at ? date_format(date_create($booking->created_at), "d M Y") : ''}}</td>
                            <td>{{$booking->event->eventDetails[0]->title ??''}}</td>
                            <td class="nowrap">@switch($booking->currency)
                                    @case('1') $ {{$booking->eventSection->price_usd ??''}} @break
                                    @case('2') {{$booking->eventSection->price_euro}} € @break
                                    @default @break
                                @endswitch
                            </td>
                            <td class="nowrap" data-order="@if($booking->event->start_date){{$booking->event->start_date ??''}} @elseif($booking->event->end_date){{$booking->event->end_date ??''}} @endif">@if($booking->event->start_date) {{ date_format(date_create($booking->event->start_date), "d M Y") }} @elseif($booking->event->end_date) {{ date_format(date_create($booking->event->start_date), "d M Y") }} @endif</td>
                            <td class="{{$booking->BookingStatusColor ??''}}">{{$booking->BookingStatusName ??''}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
