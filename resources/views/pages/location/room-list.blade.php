@extends('templates.default')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <table id="default-list-table" class="display">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Maximum Guests</th>
                        <th>Event Room</th>
                        <th>Available</th>
                        <th>Maximum Guests</th>
                        <th>Size</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rooms as $room)
                        <tr>
                            <td>{{$room->name}}</td>
                            <td>{{$room->maximum_guests}}</td>
                            <td>{{$room->is_for_events ? 'yes' : 'no'}}</td>
                            <td>{{$room->is_blocked ? 'no' : 'yes'}}</td>
                            <td>{{$room->maximum_guests}}</td>
                            <td>{{$room->size}}</td>
                            <td class="table-icon">
                                <a class="ml-1" href="{{ route('room-edit', ['language' => app()->getLocale(), 'id' => $room->id]) }}">
                                    <i class="fad fa-pencil-alt fa-lg mx-1"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
