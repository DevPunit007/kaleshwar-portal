@extends('templates.default')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
			    <div class="col mr-auto">
			        <h5 class="backend-title mt-2">List of Media Content in Timeline</h5>
			    </div>
			    <div class="col-auto text-right">
			    	<span id="select-filter-table"></span>
                    <button onclick="window.location.href = '{{ route('timeline-media-add', app()->getLocale()) }}';" type="button" class="btn btn-outline-success btn-header">Add Media Content</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="timeline-list-table" class="display responsive">
                <thead>
                <tr>
                	<th style="width: 40px;"></th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Event</th>
                    <th>Country</th>

                    <th id="select-filter-row">Type</th>
                    <th>Content</th>
                    <th>Speaker</th>
                    <th style="display: none;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($timeline_media as $entry)
                <tr>
                	<td class="nowrap table-icon">
						<i class="fas fa-chevron-circle-down fa-lg mx-1 color-green op-7"></i>
						<a href="{{ route('timeline-media-edit', ['language' => app()->getLocale(), 'id' => $entry->id]) }}"><i class="fas fa-chevron-circle-right fa-lg mx-1 color-theme-dark op-7"></i></a></td>
                  	<td class="nowrap">{{$entry->date ??''}}</td>
                  	<td>{{$entry->time ??''}}</td>
                  	<td>{{$entry->eventDetails[0]->title ??''}}</td>
                    <td>{{$entry->locationDetails[0]->country ??''}}</td>

                    <td>{{$entry->type ??''}}</td>
                    <td>{{$entry->content ??''}}</td>
                    <td>{{$entry->speaker ??''}}</td>
                    <td style="display: none;">
						<table>
							<tr><td>Location:</td><td>{{$entry->location_info ??''}}{{$entry->location_info ? ',' : ''}} {{$entry->locationDetails[0]->city ??''}}, {{$entry->locationDetails[0]->country ??''}}</td>
							<tr><td>Format:</td><td>{{$entry->format ??''}}</td></tr>
							<tr><td>Reference:</td><td>{{$entry->reference_info ??''}}</td></tr>
						</table>
					</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<pre>@php //print_r($timeline_media); @endphp </pre>

@endsection
