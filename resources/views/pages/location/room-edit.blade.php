@extends('templates.default')

@section('content')
    <div class="container">
        <div class="card rounded-0 mb-2">
            <div class="card-body">
                <form id="edit-room-form" class="enable-able-form" method="post" action="{{ route('room-edit', ['language' => app()->getLocale(), 'id' => $room->id]) }}" enctype="multipart/form-data">@csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input disabled id="name" name="name" class="form-control" value="{{$room->name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is-for-events" class="col-sm-2 col-form-label">Is for events</label>
                        <div class="col-sm-10">
                            <select id="is-for-events" name="is_for_events" disabled>
                                <option value="{{$room->is_for_events ? 'true' : 'false'}}">{{$room->is_for_events ? 'yes' : 'no'}}</option>
                                <option value="{{$room->is_for_events ? 'false' : 'true'}}">{{$room->is_for_events ? 'no' : 'yes'}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is-blocked" class="col-sm-2 col-form-label">Is blocked</label>
                        <div class="col-sm-10">
                            <select id="is-blocked" name="is_blocked" disabled>
                                <option value="{{$room->is_blocked ? 'true' : 'false'}}">{{$room->is_blocked ? 'yes' : 'no'}}</option>
                                <option value="{{$room->is_blocked ? 'false' : 'true'}}">{{$room->is_blocked ? 'no' : 'yes'}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reason-why-blocked" class="col-sm-2 col-form-label">Reason why blocked</label>
                        <div class="col-sm-10">
                            <input disabled id="reason-why-blocked" name="reason_why_blocked" class="form-control" value="{{$room->reason_why_blocked }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="maximum-guests" class="col-sm-2 col-form-label">Maximum Guests</label>
                        <div class="col-sm-10">
                            <input disabled id="maximum-guests" name="maximum_guests" class="form-control" value="{{$room->maximum_guests}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="size" class="col-sm-2 col-form-label">Size</label>
                        <div class="col-sm-10">
                            <input disabled id="size" name="size" class="form-control" value="{{$room->size}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="floor" class="col-sm-2 col-form-label">Floor</label>
                        <div class="col-sm-10">
                            <input disabled id="floor" name="floor" class="form-control" value="{{$room->floor}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input disabled id="description" name="description" class="form-control" value="{{$room->description}}">
                            {{-- input gegen textarea austauschen und div davor für ansicht html --}}
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
        </div>
    </div>
@endsection
