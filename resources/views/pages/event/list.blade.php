@extends('templates.default')

@section('content')
@include('pages.event.help-partials.list')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col mr-auto">
                    <h5 class="backend-title mt-2">List of Events</h5>
                </div>
                <div class="col-auto text-right">
                    <span id="select-filter-table"></span>
                    <button onclick="window.location.href = '{{ route('iframe-show-events', app()->getLocale()) }}';" type="button" class="btn btn-outline-primary btn-header">Preview events</button>
                    <button onclick="window.location.href = '{{ route('event-add', app()->getLocale()) }}';" type="button" class="btn btn-outline-success btn-header">Add Event</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="event-list-table" class="display">
                    <thead>
                    <tr>
                        <th style="width: 40px;"></th>
                        <th>Title</th>
                        <th>Location</th>
                        <th id="select-filter-row">Category</th>
                        <th id="select-filter-row">Organizer</th>
                        <th>Start</th>
                        <th>End</th>
                        <th @if(auth()->user()['rule_id'] === 4) class="d-none" @endif >Role</th>
                        <th class="d-none"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($eventsWhereUserIsAdmin as $event)
                        <tr>
                            <td class="details-control nowrap table-icon">
                                <i class="fas fa-chevron-circle-down fa-lg mx-1 color-green op-7"></i>
                                <a href="{{ route('event-edit', ['language' => app()->getLocale(), 'id' => $event->id]) }}">
                                    <i class="fas fa-chevron-circle-right fa-lg mx-1 color-theme-dark op-7"></i>
                                </a>
                            </td>
                            <td>@if($event->list_name){{$event->list_name}} @else <i>{{$event->eventDetails[0]->title}}</i> @endif</td>
                            <td>{{$event->locationDetails->name}}</td>
                            <td>{{$event->eventCategory->event_category_name}}</td>
                            <td>{{$event->organizer->organizer_name}}</td>
                            <td class="nowrap">{{$event->start_date ??''}}</td>
                            <td class="nowrap">{{$event->end_date}}</td>
                            <td @if(auth()->user()['rule_id'] === 4) class="d-none" @endif >Admin</td>
                            <td class="d-none">
                                <table>
                                    <tr><td>Introduction:</td><td>{{$event->eventDetails[0]->introduction}}</td></tr>
                                    <tr><td>ID:</td><td>{{$event->id}}</td></tr>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                    @foreach($eventsWhereUserIsEditor as $event)
                        <tr>
                            <td class="details-control nowrap table-icon">
                                <i class="fas fa-chevron-circle-down fa-lg mx-1 color-green op-7"></i>
                                <a href="{{ route('event-edit', ['language' => app()->getLocale(), 'id' => $event->id]) }}">
                                    <i class="fas fa-chevron-circle-right fa-lg mx-1 color-theme-dark op-7"></i>
                                </a>
                            </td>
                            <td>{{$event->eventDetails[0]->title}}</td>
                            <td>{{$event->locationDetails->name}}</td>
                            <td>{{$event->eventCategory->event_category_name}}</td>
                            <td>{{$event->organizer->organizer_name}}</td>
                            <td class="nowrap">{{$event->start_date ??''}}</td>
                            <td class="nowrap">{{$event->end_date}}</td>
                            <td @if(auth()->user()['rule_id'] === 4) class="d-none" @endif >Editor</td>
                            <td class="d-none">
                                <table>
                                    <tr><td>Introduction:</td><td>{{$event->eventDetails[0]->introduction}}</td></tr>
                                    <tr><td>ID:</td><td>{{$event->id}}</td></tr>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
