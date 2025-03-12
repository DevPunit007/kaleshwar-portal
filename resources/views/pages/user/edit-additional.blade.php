@extends('pages.user.edit--frame')

@section('user-account')

<div class="col-md-9 user-account-section p-0">
    <div class="button-bar">
        <button type="button" data-toggle="collapse" data-target="#card_new_phone" aria-expanded="false" aria-controls="card_new_phone" class="btn btn-outline-success btn-header">New Phone Number</button>
        <button type="button" data-toggle="collapse" data-target="#card_new_group" aria-expanded="false" aria-controls="card_new_group" class="btn btn-outline-success btn-header">Connect Group</button>
        @if($user->teacher_count == 0)
            <a onclick="return confirm('Do you sure you want create teacher profile?');" href="{{ route('create-teacher-by-user', ['language' => app()->getLocale(), 'id' => $user->id]) }}" class="btn btn-outline-success btn-header">Create Teacher</a>
        @endif
    </div>
    <div class="row m-0">
        {{-- Area to add group for user --}}
        <div class="col-12 collapse bg-light border-bottom p-0" id="card_new_group">
            <div class="card-body pb-0">
                <form class="new-phone-form" method="post" action="{{ route('add-user-group', app()->getLocale()) }}" enctype="multipart/form-data">@csrf
                    <div class="form-row">
                        <div class="form-group col-9">
                            <label for="organizer_id">Groups *</label>
                            <select required name="organizer_id" id="organizer_id" class="custom-select bg-white">
                                <option value="" selected>Please select</option>
                                @foreach($allGroups as $group)
                                    @php $userOrganizersCount = $userOrganizers->whereIn('organizer_id', $group->id)->count(); @endphp
                                    <option @if($userOrganizersCount > 0) disabled @endif value="{{$group->id}}">{{$group->organizer_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="custom-select bg-white">
                                <option value="member" selected>Member</option>
                                <option value="editor">Editor</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row pb-0 mt-2">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                            <button type="submit" class="btn btn-primary submit-button btn-header">Save</button>
                            <button type="button" id="close-group-section" data-target="#card_new_group" class="btn btn-dark btn-header ml-2">Close</button>
                        </div>
                        <div class="form-group">
                            <label class="color-gray">* These fields are required</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @include('pages.user.form-partials.form-user-phone')

        <div class="col-lg-6 user-account-section p-0">
            <div class="card-body">
                <h6>List of connected groups</h6>
                <ul class="list-group list-scroll">
                    @foreach($userOrganizers as $userOrganizer)
                        <li class="list-group-item bg-light">
                            <a href="{{ route('group-edit', ['language' => app()->getLocale(), 'id' => $userOrganizer->organizer->id]) }}">{{$userOrganizer->organizer->organizer_name ??''}}</a>
                            <span class="text-muted text-small">({{$userOrganizer->role ??''}})</span>
                            <span class="float-right">
                                {{--<a data-target="#card_new_group" aria-expanded="false" aria-controls="card_new_group" data-value="{{$userOrganizer}}"><i class="fad fa-pen"></i></a>--}}
                                @if($userOrganizer->role !== 'admin')
                                    <a onclick="return confirm('Do you sure you want delete that group connection?');" href="{{ route('delete-user-group', ['language' => app()->getLocale(), 'id' => $userOrganizer->id]) }}"><i class="fad fa-eraser"></i></a>
                                @endif
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
