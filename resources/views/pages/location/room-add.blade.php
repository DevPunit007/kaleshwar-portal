@extends('templates.default')

@section('content')
    <div class="container">
        <div class="card rounded-0 mb-2">
            <div class="card-body">
                <form id="add-room-form" class="enable-able-form" method="post" action="{{ route('room-add', ['language' => app()->getLocale()]) }}" enctype="multipart/form-data">@csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input id="name" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="location-id" class="col-sm-2 col-form-label">Location</label>
                        <div class="col-sm-10">
                            <select id="location-id" name=location_id">
                                @foreach($locations as $location)
                                    <option value="{{$location->id}}">{{$location->locationDetails[0]->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="building-id" class="col-sm-2 col-form-label">Building</label>
                        <div class="col-sm-10">
                            <select id="building-id" name=building_id">
                                @foreach($buildings as $building)
                                    <option value="{{$building->id}}">{{$building->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is-for-events" class="col-sm-2 col-form-label">Is for events</label>
                        <div class="col-sm-10">
                            <select id="is-for-events" name="is_for_events">
                                <option value="false">no</option>
                                <option value="true">yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is-blocked" class="col-sm-2 col-form-label">Is blocked</label>
                        <div class="col-sm-10">
                            <select id="is-blocked" name="is_blocked">
                                <option value="false">no</option>
                                <option value="true">yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reason-why-blocked" class="col-sm-2 col-form-label">Reason why blocked</label>
                        <div class="col-sm-10">
                            <input id="reason-why-blocked" name="reason_why_blocked" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="maximum-guests" class="col-sm-2 col-form-label">Maximum Guests</label>
                        <div class="col-sm-10">
                            <input id="maximum-guests" name="maximum_guests" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="size" class="col-sm-2 col-form-label">Size</label>
                        <div class="col-sm-10">
                            <input id="size" name="size" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="floor" class="col-sm-2 col-form-label">Floor</label>
                        <div class="col-sm-10">
                            <input id="floor" name="floor" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input id="description" name="description" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary float-right submit-button">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
