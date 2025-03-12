@extends('templates.default')

@section('content')

    <div class="container">

    @if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif


	<div class="card rounded mb-2 enable-able-form">
		<div class="card-header rounded-top">
			<div class="row">
				<div class="col mr-auto">
					<h5 class="mt-2">@if($location) Edit @else Add @endif Location</h5>
				</div>
				<div class="col-auto text-right">
					<div class="btn-group">
					  <button type="button" class="btn btn-outline-info dropdown-toggle mx-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Language
					  </button>
					  <div class="dropdown-menu">
					  	@foreach($location->locationDetails as $locationDetail)
							<a class="dropdown-item @if($loop->first) active show @endif" id="{{$locationDetail->language}}-tab" data-toggle="tab" href="#{{$locationDetail->language}}Form"
							   aria-controls="{{$locationDetail->language}}Tab" aria-selected="true">{{__('login.language.' . $locationDetail->language)}}</a>
						@endforeach
					  </div>
					</div>
					<a class="btn btn-outline-secondary mx-1" href="{{route('location-add-translation', ['language' => app()->getLocale(), 'id' => $location->id]) }}">Add Translation</a>

					@if($location)
					<button type="button" class="btn btn-outline-dark edit-button mx-1">Edit</button>
					<button onclick="alert('Function Delete will come soon');" type="button" class="btn btn-outline-danger submit-button mx-1" disabled hidden>Delete</button>
					<button onclick="alert('Function Log will come soon');" type="button" class="btn btn-outline-secondary mx-1">Change log</button>
					@endif
					<button onclick="window.location.href='{{ route('location-list', app()->getLocale()) }}';" type="button" class="btn btn-outline-secondary mx-1">Back</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="tab-content" id="myTabContent">
				@foreach($location->locationDetails as $locationDetail)
					<div class="tab-pane fade @if($loop->first) active show @endif" id="{{$locationDetail->language}}Form" role="tabpanel" aria-labelledby="{{$locationDetail->language}}-tab">
						<form id="edit-location-form-{{$locationDetail->language}}" class="" action="{{ route('location-edit', ['language' => app()->getLocale(), 'id' => $location->id]) }}" method="post">@csrf
							<div class="form-group row">
								<label for="name" class="col-sm-2 col-form-label">Name</label>
								<div class="col-sm-10">
									<input disabled id="name" name="name" class="form-control" value="{{$locationDetail->name}}">
								</div>
							</div>
							<p>{{$location->geodata}}
							<div class="form-group row">
								<label for="address-street" class="col-sm-2 col-form-label">Street</label>
								<div class="col-sm-10">
									<input disabled id="address-street" name="address_street" class="form-control" value="{{$locationDetail->address_street}}">
								</div>
							</div>
							<div class="form-group row">
								<label for="address-no" class="col-sm-2 col-form-label">Address Number</label>
								<div class="col-sm-10">
									<input disabled id="address-no" name="address_no" class="form-control" value="{{$locationDetail->address_no}}">
								</div>
							</div>
							<div class="form-group row">
								<label for="address-supplements" class="col-sm-2 col-form-label">Address Supplements</label>
								<div class="col-sm-10">
									<input disabled id="address-supplements" name="address_supplements" class="form-control" value="{{$locationDetail->address_supplements}}">
								</div>
							</div>
							<div class="form-group row">
								<label for="city" class="col-sm-2 col-form-label">City</label>
								<div class="col-sm-10">
									<input disabled id="city" name="city" class="form-control" value="{{$locationDetail->city}}">
								</div>
							</div>
							<div class="form-group row">
								<label for="state" class="col-sm-2 col-form-label">State</label>
								<div class="col-sm-10">
									<input disabled id="state" name="state" class="form-control" value="{{$locationDetail->state}}">
								</div>
							</div>
							<div class="form-group row">
								<label for="zip" class="col-sm-2 col-form-label">Zip</label>
								<div class="col-sm-10">
									<input disabled id="zip" name="zip" class="form-control" value="{{$locationDetail->zip}}">
								</div>
							</div>
							<div class="form-group row">
								<label for="country" class="col-sm-2 col-form-label">Country</label>
								<div class="col-sm-10">
									<input disabled id="country" name="country" class="form-control" value="{{$locationDetail->country}}">
								</div>
							</div>

							<div class="form-group row">
								<div class="col-12">
									<button type="button" class="btn btn-dark float-right edit-button">Edit</button>
									<button disabled hidden type="submit" class="btn btn-primary float-right submit-button">Save changes</button>
								</div>
							</div>
						</form>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<div class="card mb-5">
		<div class="card-header">
			<h4>Buildings of this location</h4>
		</div>
		<div class="card-body">
			<form id="add-building-form" action="{{ route('building-add', ['language' => app()->getLocale()]) }}" method="post">@csrf
				<div class="form-group row">
					<div class="col-sm-4">
						<div class="input-group">
							<input id="name" name="name" class="form-control" value="" placeholder="Add building to location">
							<input hidden readonly id="location-id" name="location_id" class="form-control" value="{{$location->id}}">
							<div class="input-group-append">
								<button type="submit" class="btn btn-primary"><i class="fad fa-save" style="color: white;"></i></button>
							</div>
						</div>
					</div>
				</div>
			</form>
			@foreach($location->buildings as $building)
				<form class="edit-building-form" class="enable-able-form" action="{{ route('building-edit', ['language' => app()->getLocale(), 'id' => $building->id]) }}" method="post">@csrf
					<div class="form-group row">
						<div class="col-sm-4">
							<div class="input-group">
								<input disabled id="name" name="name" class="form-control" value="{{$building->name}}">
								<div class="input-group-append">
									<button type="button" class="btn btn-primary edit-button"><i class="fad fa-pencil-alt" style="color: white;"></i></button>
									<button disabled hidden type="submit" class="btn btn-primary submit-button"><i class="fad fa-save" style="color: white;"></i></button>
								</div>
							</div>
						</div>
					</div>
				</form>
			@endforeach
		</div>
	</div>
</div>

<pre>@php //print_r($location); @endphp </pre>

@endsection
