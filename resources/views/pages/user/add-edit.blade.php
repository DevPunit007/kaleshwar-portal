@extends('templates.default')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<style>
    .nav-link {
        border-radius: unset !important;
    }
    a.nav-link {
        color: #797978 !important;
    }
    .nav-link.active {
        color: #650000 !important;
        background-color: #e9ecef !important;
    }
</style>
<div class="row iframe-view">
	<div class="col-12">
		<div class="card rounded mb-5">
			<div class="card-header">
				<div class="row">
					<div class="col mr-auto">
						<h5 class="backend-title mt-2">User Account</h5>
					</div>
					<div class="col-auto text-right">
						<a class="dropdown-item" href="{{ route('logout', app()->getLocale()) }}">{{ __('Logout') }}</a>
					</div>
				</div>
			</div>
			<div class="row m-0">
				<div class="col-lg-3 p-0">
					<div class="card-body px-0 py-4">
						<div class="nav flex-column nav-pills text-center text-lg-left" id="v-pills-tab" role="tablist" aria-orientation="vertical">
							<a class="nav-link active" id="basic-information-tab" data-toggle="pill" href="#basicInformation" role="tab" aria-controls="basic-information-tab" aria-selected="true">Basic information</a>
							<a class="nav-link" id="contact-information-tab" data-toggle="pill" href="#contactInformation" role="tab" aria-controls="contactInformation" aria-selected="false">Contact Information</a>
							<a class="nav-link" id="personal-information-tab" data-toggle="pill" href="#personalInformation" role="tab" aria-controls="personalInformation" aria-selected="false">Personal Information</a>
							<a class="nav-link" id="spiritual-history-tab" data-toggle="pill" href="#spiritualHistory" role="tab" aria-controls="spiritualHistory" aria-selected="false">Spiritual History</a>
							@if(auth()->user()['rule_id'] > 2) <a class="nav-link" id="admin-console-tab" href="{{ route('home', app()->getLocale()) }}" target="_parent" role="tab">Admin Console</a> @endif
						</div>
					</div>
				</div>
				<div class="col-lg-9 p-0">
					<div class="tab-content p-0" id="user-add-edit-section" style="border-left: 1px solid lightgray; min-height: 545px;">
						<div class="tab-pane fade active show" id="basicInformation" role="tabpanel" aria-labelledby="basic-information-tab">
							<div class="card-body">
								<form class="enable-able-form" method="post" action="{{ route('edit-user-basic', ['language' => app()->getLocale(), 'id' => $user->id]) }}" enctype="multipart/form-data">@csrf
									<div class="form-row">
										<div class="form-group col-lg-6">
											<label for="first_name">First name *</label>
											<input required name="first_name" type="text" class="form-control" id="first_name" value="{{$user->first_name ??''}}" disabled>
										</div>
										<div class="form-group col-lg-6">
											<label for="middle_name">Middle name</label>
											<input name="middle_name" type="text" class="form-control" id="middle_name" value="{{$user->middle_name ??''}}" disabled>
										</div>

									</div>

									<div class="form-row">
										<div class="form-group col-lg-6">
											<label for="last_name">Last name *</label>
											<input required name="last_name" type="text" class="form-control" id="last_name" value="{{$user->last_name ??''}}" disabled>
										</div>
										<div class="form-group col-lg-6">
											<label for="nickname">Nick name</label>
											<input name="nickname" type="text" class="form-control" id="nickname" value="{{$user->nickname ??''}}" disabled>
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-lg-8">
											<label for="email">E-Mail *</label>
											<span class="form-control" id="email">{{$user->email ??''}}</span>
										</div>
										<div class="form-group col-lg-4">
											<label for="language_code">Language *</label>
											<select required name="language_code" id="language_code" class="form-control" disabled>
												<option value="" disabled hidden selected>Please select a language</option>
												<option value="de" @if($user) @if($user->language_code == 'de') selected @endif @endif>German</option>
												<option value="en" @if($user) @if($user->language_code == 'en') selected @endif @endif>English</option>
											</select>
										</div>
									</div>

									<div class="form-row pb-0 mt-2">
										<div class="form-group">
											@if($user)<button type="button" class="btn btn-dark edit-button">Edit</button>@endif
											<button @if($user) disabled hidden @endif type="submit" class="btn btn-primary submit-button">Save</button>
										</div>
										<div class="form-group">
											<label class="color-gray">* These fields are required</label>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="tab-pane fade" id="contactInformation" role="tabpanel" aria-labelledby="contact-information-tab">
							<div class="card-body">
								<form id="contact-information-form" class="enable-able-form" action="{{ route('edit-user-contact', ['language' => app()->getLocale(), 'id' => $user->id]) }}" method="post"> @csrf
									<div class="form-row">
										<div class="form-group col-lg-9">
											<label for="address_street">Street</label>
											<input id="address_street" name="address_street" type="text" class="form-control" value="{{$user->contactInformation->address_street ??''}}" disabled>
										</div>
										<div class="form-group col-lg-3">
											<label for="address_no">House No</label>
											<input id="address_no" name="address_no" type="text" class="form-control" value="{{$user->contactInformation->address_no ??''}}" disabled>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-lg-12">
											<label for="address_supplements">Supplements</label>
											<input id="address_supplements" name="address_supplements" type="text" class="form-control" value="{{$user->contactInformation->address_supplements ??''}}" disabled>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-lg-7">
											<label for="city">City</label>
											<input disabled id="city" name="city" type="text" class="form-control" value="{{$user->contactInformation->city ??''}}"> @error('city')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
										</div>
										<div class="form-group col-lg-5">
											<label for="zip">Zip</label>
											<input disabled id="zip" name="zip" type="text" class="form-control  @error('zip') is-invalid @enderror" value="{{$user->contactInformation->zip ??''}}"> @error('zip')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
										</div>

									</div>
									<div class="form-row">
										<div class="form-group col-lg-6">
											<label for="country">Country</label>
											<input disabled id="country" name="country" type="text" class="form-control  @error('country') is-invalid @enderror" value="{{$user->contactInformation->country ??''}}"> @error('country')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
										</div>
										<div class="form-group col-lg-6">
											<label for="state">State</label>
											<input disabled id="state" name="state" type="text" class="form-control  @error('state') is-invalid @enderror" value="{{$user->contactInformation->state ??''}}"> @error('country')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
										</div>
									</div>
									<div class="form-row pb-0 mt-2">
										<div class="form-group">
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
											@if($user)<button type="button" class="btn btn-dark edit-button">Edit</button>@endif
											<button @if($user) disabled hidden @endif type="submit" class="btn btn-primary submit-button">Save</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="tab-pane fade" id="personalInformation" role="tabpanel" aria-labelledby="contact-information-tab">
							<div class="card-body">
								<form id="personal-information-form" class="enable-able-form" action="{{ route('edit-user-personal', ['language' => app()->getLocale(), 'id' => $user->id]) }}" method="post"> @csrf
									<div class="form-row">
										<div class="form-group col-lg-3">
											<label for="date_of_birth">Date of Birth</label>
											<input disabled id="date_of_birth" name="date_of_birth" type="date" class="form-control" value="{{$user->personalInformation->date_of_birth ??''}}">
										</div>
										<div class="form-group col-lg-3">
											<label for="time_of_birth">Time of Birth</label>
											<input disabled id="time_of_birth" name="time_of_birth" type="time" class="form-control" value="{{$user->personalInformation->time_of_birth ??''}}">
										</div>
										<div class="form-group col-lg-6">
											<label for="state">Place of Birth</label>
											<input disabled id="place_of_birth" name="place_of_birth" type="text" class="form-control" value="{{$user->personalInformation->place_of_birth ??''}}">
										</div>
									</div>
									<div class="form-row">
									    <div class="form-group col-6 col-lg-3">
											<label for="gender">Gender</label>
											<select name="gender" id="gender" class="form-control" disabled>
												<option value="">Please select</option>
												<option value="1" @if($user->personalInformation && $user->personalInformation->gender == '1') selected @endif>Male</option>
												<option value="2" @if($user->personalInformation && $user->personalInformation->gender == '2') selected @endif>Female</option>
											</select>
										</div>
										<div class="form-group col-6 col-lg-3">
											<label for="married">Married</label>
											<select name="married" id="married" class="form-control" disabled>
												<option value="">Please select</option>
												<option value="1" @if($user->personalInformation && $user->personalInformation->married == '1') selected @endif>No</option>
												<option value="2" @if($user->personalInformation && $user->personalInformation->married == '2') selected @endif>Yes</option>
											</select>
										</div>
										<div class="form-group col-lg-6">
											<label for="name_of_spouse">Name of Spouse</label>
											<input disabled id="name_of_spouse" name="name_of_spouse" class="form-control  @error('name_of_spouse') is-invalid @enderror" value="{{$user->personalInformation->name_of_spouse ??''}}"> @error('name_of_spouse')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-lg-4">
											<label for="name_of_father">Name of Father</label>
											<input disabled id="name_of_father" name="name_of_father" class="form-control  @error('name_of_father') is-invalid @enderror" value="{{$user->personalInformation->name_of_father ??''}}"> @error('name_of_father')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
										</div>
										<div class="form-group col-lg-4">
											<label for="name_of_mother">Name of Mother</label>
											<input disabled id="name_of_mother" name="name_of_mother" class="form-control  @error('name_of_mother') is-invalid @enderror" value="{{$user->personalInformation->name_of_mother ??''}}"> @error('name_of_mother')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
										</div>
										<div class="form-group col-lg-4">
											<label for="profession">Profession</label>
											<input disabled id="profession" name="profession" class="form-control  @error('profession') is-invalid @enderror" value="{{$user->personalInformation->profession ??''}}"> @error('profession')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
										</div>
									</div>


									<div class="form-row pb-0 mt-2">
										<div class="form-group">
											@if($user)<button type="button" class="btn btn-dark edit-button">Edit</button>@endif
											<button @if($user) disabled hidden @endif type="submit" class="btn btn-primary submit-button">Save</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="tab-pane fade" id="spiritualHistory" role="tabpanel" aria-labelledby="spiritual-history-tab">
							<div class="card-body">
								<form id="spiritual-history-form" class="enable-able-form" action="{{ route('edit-user-spiritual', ['language' => app()->getLocale(), 'id' => $user->id]) }}" method="post"> @csrf
									<div class="form-row">
										<div class="form-group col-12">
											<label for="first_meet">First Meet</label>
											<input disabled id="first_meet" name="first_meet" class="form-control  @error('first_meet') is-invalid @enderror" value="{{$user->spiritualHistory->first_meet ??''}}">
											@error('first_meet')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
										</div>

									</div>

									<div class="form-row">
										<div class="form-group col-12">
											<label for="events_kaleshwar">Events with Sri Kaleshwar</label>
											<textarea id="events_kaleshwar" name="events_kaleshwar" class="form-control" rows="2" disabled>{{$user->spiritualHistory->events_kaleshwar ??''}}</textarea>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-12">
											<label for="processes_kaleshwar">Meditation processes from Sri Kaleshwar</label>
											<textarea id="processes_kaleshwar" name="processes_kaleshwar" class="form-control" rows="2" disabled>{{$user->spiritualHistory->processes_kaleshwar ??''}}</textarea>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-6 col-lg-3">
											<label for="ashram_visited">Ever visited Ashram </label>
											<select name="ashram_visited" id="ashram_visited" class="form-control" disabled>
												<option value="">Please select</option>
												<option value="2" @if($user->spiritualHistory && $user->spiritualHistory->ashram_visited == '2') selected @endif>No</option>
												<option value="1" @if($user->spiritualHistory && $user->spiritualHistory->ashram_visited == '1') selected @endif>Yes</option>
											</select>
										</div>
										<div class="form-group col-6 col-lg-3">
											<label for="attend_ie2011">Attended IE 2011</label>
											<select name="attend_ie2011" id="attend_ie2011" class="form-control" disabled>
												<option value="">Please select</option>
												<option value="2" @if($user->spiritualHistory && $user->spiritualHistory->attend_ie2011 == '2') selected @endif>No</option>
												<option value="1" @if($user->spiritualHistory && $user->spiritualHistory->attend_ie2011 == '1') selected @endif>Yes</option>
											</select>
										</div>
									</div>

									<div class="form-row pb-0 mt-2">
										<div class="form-group">
											@if($user)<button type="button" class="btn btn-dark edit-button">Edit</button>@endif
											<button @if($user) disabled hidden @endif type="submit" class="btn btn-primary submit-button">Save</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
