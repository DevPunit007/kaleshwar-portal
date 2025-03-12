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

            <div class="row">
                <div class="col-12">
                    <div class="card rounded mb-5">
                        <div class="card-header">
                            <div class="row">
                                <div class="col mr-auto">
                                    <h5 class="backend-title mt-2">Add {{ucfirst($type)}}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form method="post"
                                  action="{{ route('organizer-add', ['language' => app()->getLocale(), 'type' => $type]) }}"
                                  enctype="multipart/form-data">@csrf
                                @if($type !== 'teacher')
                                <div class="form-group row">
                                    <label for="organizer-name" class="col-sm-2 col-form-label">{{ucfirst($type)}} Name</label>
                                    <div class="col-sm-10">
                                        <input id="organizer-name" name="organizer_name" class="form-control" value="">
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row">
                                    <label for="admin-id" class="col-sm-2 col-form-label">{{$type === 'teacher' ? 'Select Teacher' : 'Admin'}}</label>
                                    <div class="col-sm-10">
                                        <select name="admin_id" id="admin-id" class="custom-select col-lg-6 col-sm-12">
                                            <option value="9000">Ashram Team</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary float-right submit-button">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </div>
@endsection
