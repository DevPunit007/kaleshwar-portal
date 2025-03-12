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
                            <h5 class="backend-title mt-2">User data from {{$user->first_name ??''}} {{$user->last_name ??''}}</h5>
                        </div>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-md-3 p-0">
                        <div class="card-body px-0 py-4">
                            <div class="nav flex-column nav-pills text-center text-md-left" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link" id="edit-basic" href="{{ route('user-edit-basic', ['language' => app()->getLocale(), 'id' => $user->id]) }}">Basic information</a>
                                <a class="nav-link" id="edit-contact" href="{{ route('user-edit-contact', ['language' => app()->getLocale(), 'id' => $user->id]) }}">Contact Information</a>
                                <a class="nav-link" id="edit-personal" href="{{ route('user-edit-personal', ['language' => app()->getLocale(), 'id' => $user->id]) }}">Personal Information</a>
                                <a class="nav-link" id="edit-spiritual" href="{{ route('user-edit-spiritual', ['language' => app()->getLocale(), 'id' => $user->id]) }}">Spiritual History</a>
                                <a class="nav-link" id="edit-additional" href="{{ route('user-edit-additional', ['language' => app()->getLocale(), 'id' => $user->id]) }}">Additional Data</a>

                                <a class="nav-link mt-4" id="edit-ashram" href="{{ route('user-edit-ashram', ['language' => app()->getLocale(), 'id' => $user->id]) }}">Ashram Data</a>
                                <a class="nav-link" id="edit-bookings" href="{{ route('user-edit-bookings', ['language' => app()->getLocale(), 'id' => $user->id]) }}">User bookings</a>
                                <a class="nav-link" id="edit-files" href="{{ route('user-edit-files', ['language' => app()->getLocale(), 'id' => $user->id]) }}">User files</a>
                            </div>
                        </div>
                    </div>

                    @yield('user-account')

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        let path_name = location.pathname.substring(location.pathname.lastIndexOf('/') + 1);
        $('.nav a[id="' + path_name + '"]').addClass('active');
    });
</script>

@endsection
