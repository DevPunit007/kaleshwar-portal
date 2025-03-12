@extends('templates.default')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col mr-auto">
                        <h5 class="backend-title mt-2">List of Groups</h5>
                    </div>
                    <div class="col-auto text-right">
                        <span id="select-filter-table"></span>
                        <button onclick="window.location.href = '{{ route('organizer-add', ['language' => app()->getLocale(), 'type' => 'group']) }}';"
                                type="button" class="btn btn-outline-success btn-header">Add Group
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="default-list-table" class="display">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Admin</th>
                        <th>Editors</th>
                        <th>Members</th>
                        <th>Current Events</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <td>{{$group->organizer_name}}</td>
                            <td>{{$group->admin->first_name}} {{$group->admin->last_name}}</td>
                            <td>{{$group->editorCount}}</td>
                            <td>{{$group->memberCount}}</td>
                            <td>{{$group->eventCount}}</td>
                            <td class="nowrap table-icon">
                                <a class="ml-1"
                                   href="{{ route('group-edit', ['language' => app()->getLocale(), 'id' => $group->id]) }}">
                                    <i class="fad fa-info-circle fa-lg mx-1"></i>
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
