@extends('templates.default')

@section('content')
@include('pages.event.help-partials.list')
<div class="container">
	<div class="card">
		<div class="card-header">
            <div class="row">
			    <div class="col mr-auto">
			        <h5 class="backend-title mt-2">List of Locations</h5>
			    </div>
			    <div class="col-auto text-right">
			    	<span id="select-filter-table"></span>
                    <button onclick="window.location.href = '{{ route('location-add', app()->getLocale()) }}';" type="button" class="btn btn-outline-success btn-header">Add Location</button>
                </div>
            </div>
        </div>
		<div class="card-body">
            <div class="table-responsive">
                <table id="location-list-table" class="display">
                    <thead>
                    <tr>
                        <th style="width: 40px;"></th>
                        <th>Name</th>
                        <th>City</th>
                        <th id="select-filter-row">Country</th>
                        <th>Rooms</th>
                        <th>Events</th>
                        <th></th>
                        <th style="display: none;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td class="details-control nowrap table-icon">
                                <i class="fas fa-chevron-circle-down fa-lg mx-1 color-green op-7"></i>
                                <a href="{{ route('location-edit', ['language' => app()->getLocale(), 'id' => $location->id]) }}">
                                    <i class="fas fa-chevron-circle-right fa-lg mx-1 color-theme-dark op-7"></i>
                                </a>
                            </td>
                            <td>{{$location->locationDetails[0]->name}}</td>
                            <td>{{$location->locationDetails[0]->city}}</td>
                            <td>{{$location->locationDetails[0]->country}}</td>
                            <td>{{$location->roomCount}}</td>
                            <td>{{$location->eventCount}}</td>
                            <td>

                            </td>
                            <td style="display: none;">
                                <table class="table-in-row">
                                <tr>
                                    <td class="mx-4">
                                        <p class="m-0">{{$location->locationDetails[0]->address_street}} {{$location->locationDetails[0]->address_no}}</p>
                                        <p class="m-0">{{$location->locationDetails[0]->zip}} {{$location->locationDetails[0]->city}}</p>
                                        <p class="m-0">{{$location->locationDetails[0]->country}}</p>
                                    </td>
                                    <td class="table-icon">
                                        <a href="https://www.google.com/maps/place/{{$location->locationDetails[0]->address_street.'+'.$location->locationDetails[0]->address_no.', '.$location->locationDetails[0]->city.', '.$location->locationDetails[0]->zip.', '.$location->locationDetails[0]->country}}" target="_blank">
                                            <i class="fad fa-globe-stand fa-lg mx-1"></i>
                                        </a>
                                    </td>
                                </tr>
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
