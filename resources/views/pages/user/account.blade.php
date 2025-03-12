@extends('templates.default')

@section('content')
    <div id="user-account-page" class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card rounded-0 mb-2">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="contact-information-tab" data-toggle="tab" href="#contactInformation" role="tab"
                           aria-controls="contactInformation" aria-selected="true">Contact Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="personal-information-tab" data-toggle="tab" href="#personalInformation" role="tab"
                           aria-controls="personalInformation" aria-selected="false">Personal Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="spiritual-history-tab" data-toggle="tab" href="#spiritualHistory" role="tab" aria-controls="spiritualHistory"
                           aria-selected="false">Spiritual History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="file-upload-tab" data-toggle="tab" href="#fileUpload" role="tab" aria-controls="fileUpload"
                           aria-selected="false">File Upload</a>
                    </li>
                    <span class="float-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-brand dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">{{ app()->getLocale() }}</button> {{-- Config::get('app.locale') --}}
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 33px, 0px);">
                            @foreach($languages as $language)
                                <a class="dropdown-item" href="{{route('home', $language->language_code)}}">{{__('login.language.' . $language->language_code)}}</a>
                            @endforeach
                        </div>
                    </div>
                    </span>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="contactInformation" role="tabpanel" aria-labelledby="contact-information-tab">
                        <form id="contact-information-form" class="enable-able-form" action="{{ route('user-edit-contact', ['language' => app()->getLocale(), 'id' => $user->id]) }}" method="post"> @csrf
                            <div class="form-group row">
                                <label for="first-name" class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-sm-10">
                                    <input disabled id="first-name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{$user->first_name}}">
                                    @error('first_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="last-name" class="col-sm-2 col-form-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input disabled id="last-name" name="last_name" class="form-control  @error('last_name') is-invalid @enderror" value="{{$user->last_name}}"></div>
                                    @error('last_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group row">
                                <label for="address_street" class="col-sm-2 col-form-label">Street</label>
                                <div class="col-sm-10">
                                    <input disabled id="address-street" name="address_street" class="form-control  @error('address_street') is-invalid @enderror" value="{{$contactInformation->address_street}}">
                                    @error('address_street')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="zip" class="col-sm-2 col-form-label">Zip</label>
                                <div class="col-sm-10">
                                    <input disabled id="zip" name="zip" class="form-control  @error('zip') is-invalid @enderror" value="{{$contactInformation->zip}}">
                                    @error('zip')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="city" class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-10">
                                    <input disabled id="city" name="city" class="form-control  @error('city') is-invalid @enderror" value="{{$contactInformation->city}}">
                                    @error('city')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="country" class="col-sm-2 col-form-label">Country</label>
                                <div class="col-sm-10">
                                    <input disabled id="country" name="country" class="form-control  @error('country') is-invalid @enderror" value="{{$contactInformation->country}}">
                                    @error('country')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
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
                    <div class="tab-pane fade" id="personalInformation" role="tabpanel" aria-labelledby="contact-information-tab">
                        <form id="personal-information-form" class="enable-able-form" action="{{ route('user-edit-personal', ['language' => app()->getLocale(), 'id' => $user->id]) }}" method="post"> @csrf
                            <div class="form-group row">
                                <label for="date-of-birth" class="col-sm-2 col-form-label">Date of Birth</label>
                                <div class="col-sm-10">
                                    <input disabled autocomplete="off" id="date-of-birth" name="date_of_birth" class="form-control datepicker  @error('date_of_birth') is-invalid @enderror" value="{{$personalInformation->date_of_birth}}">
                                    @error('date_of_birth')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="time-of-birth" class="col-sm-2 col-form-label">Time of Birth</label>
                                <div class="col-sm-10">
                                    <input disabled id="time-of-birth" name="time_of_birth" class="form-control @error('time_of_birth') is-invalid @enderror" value="{{$personalInformation->time_of_birth}}">
                                    @error('time_of_birth')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-10">
                                    <input disabled id="gender" name="gender" class="form-control  @error('gender') is-invalid @enderror" value="{{$personalInformation->gender}}">
                                    @error('gender')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="married" class="col-sm-2 col-form-label">Married</label>
                                <div class="col-sm-10"><input disabled id="married" name="married" class="form-control  @error('married') is-invalid @enderror"
                                                              value="{{$personalInformation->married}}"></div>
                            </div>
                            <div class="form-group row">
                                <label for="name-of-spouse" class="col-sm-2 col-form-label">Name of Spouse</label>
                                <div class="col-sm-10">
                                    <input disabled id="name-of-spouse" name="name_of_spouse" class="form-control  @error('name_of_spouse') is-invalid @enderror" value="{{$personalInformation->name_of_spouse}}">
                                    @error('name_of_spouse')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name-of-father" class="col-sm-2 col-form-label">Name of Father</label>
                                <div class="col-sm-10">
                                    <input disabled id="name-of-father" name="name_of_father" class="form-control  @error('name_of_father') is-invalid @enderror" value="{{$personalInformation->name_of_father}}">
                                    @error('name_of_father')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name-of-mother" class="col-sm-2 col-form-label">Name of Mother</label>
                                <div class="col-sm-10">
                                    <input disabled id="name-of-mother" name="name_of_mother" class="form-control  @error('name_of_mother') is-invalid @enderror" value="{{$personalInformation->name_of_mother}}">
                                    @error('name_of_mother')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profession" class="col-sm-2 col-form-label">Profession</label>
                                <div class="col-sm-10">
                                    <input disabled id="profession" name="profession" class="form-control  @error('profession') is-invalid @enderror" value="{{$personalInformation->profession}}">
                                    @error('profession')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
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
                    <div class="tab-pane fade" id="spiritualHistory" role="tabpanel" aria-labelledby="spiritual-history-tab">
                        <form id="spiritual-history-form" class="enable-able-form" action="{{ route('user-edit-spiritual', ['language' => app()->getLocale(), 'id' => $user->id]) }}" method="post"> @csrf
                            <div class="form-group row">
                                <label for="first-meet" class="col-sm-2 col-form-label">First Meet</label>
                                <div class="col-sm-10">
                                    <input disabled id="first-meet" name="first_meet" class="form-control @error('first_meet') is-invalid @enderror" value="{{$spiritualHistory->first_meet}}">
                                    @error('first_meet')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="courses-kaleshwar" class="col-sm-2 col-form-label">Courses Kaleshwar</label>
                                <div class="col-sm-10">
                                    <input disabled id="courses-kaleshwar" name="courses_kaleshwar" class="form-control @error('courses_kaleshwar') is-invalid @enderror" value="{{$spiritualHistory->courses_kaleshwar}}">
                                    @error('courses_kaleshwar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="programs-kaleshwar" class="col-sm-2 col-form-label">Programs Kaleshwar</label>
                                <div class="col-sm-10">
                                    <input disabled id="programs-kaleshwar" name="programs_kaleshwar" class="form-control @error('programs_kaleshwar') is-invalid @enderror" value="{{$spiritualHistory->programs_kaleshwar}}">
                                    @error('programs_kaleshwar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="in-group-or-class" class="col-sm-2 col-form-label">In Group or Class</label>
                                <div class="col-sm-10">
                                    <input disabled id="in-group-or-class" name="in_group_or_class" class="form-control @error('in_group_or_class') is-invalid @enderror" value="{{$spiritualHistory->in_group_or_class}}">
                                    @error('in_group_or_class')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
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
                    <div class="tab-pane fade" id="fileUpload" role="tabpanel" aria-labelledby="file-upload-tab">
                        <form id="file-upload-form" class="enable-able-form" action="{{ route('store-user-images', ['language' => app()->getLocale(), 'id' => $user->id]) }}" method="post" enctype="multipart/form-data"> @csrf
                            <div class="form-group row align-items-center">
                                <label for="in-group-or-class" class="col-sm-2 col-form-label">Profile Picture</label>
                                <div class="col-sm-10 input-group">
                                    <input disabled type="file" id="profile-image" name="profile_image" class="form-control" value="">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary px-1 py-0">
                                            @if($profileImage)
                                                <img style="border-radius: 10px; border: 1px solid blue; height: 30px; width: 30px;" src="{{url('storage/' . $profileImage->path)}}" alt="Profile Image">
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="in-group-or-class" class="col-sm-2 col-form-label">Passport Picture</label>
                                <div class="col-sm-10 input-group">
                                    <input disabled type="file" id="passport-image" name="passport_image" class="form-control" value="">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary px-1 py-0">
                                            @if($passportImage)
                                                <img style="border-radius: 10px; border: 1px solid blue; height: 30px; width: 30px;" src="{{url('storage/' . $passportImage->path)}}" alt="Passport Image">
                                            @endif
                                        </button>
                                    </div>
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
        </div>
    </div>
@endsection
