@extends('templates.default')

@section('content')
<div id="edit-user-page" class="container">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card rounded mb-5">
        <div class="card-header">
            <div class="row">
                <div class="col mr-auto">
                    <h5 class="backend-title mt-2">@if($user) Edit @else Add @endif User :: Basic information</h5>
                </div>
                <div class="col-auto text-right">
                    @if($user)
                        <button onclick="alert('Function Delete will come soon');" type="button" class="btn btn-outline-danger submit-button mx-1" disabled hidden>Delete</button>
                        <button onclick="alert('Function Log will come soon');" type="button" class="btn btn-outline-secondary mx-1">Change log</button>
                    @endif
                    <button onclick="window.location.href='{{ route('user-list', app()->getLocale()) }}';" type="button" class="btn btn-outline-secondary mx-1">Back</a>
                </div>
            </div>
        </div>


        <div class="card-body">
            <form class="enable-able-form" method="post" @if($user) action="{{ route('edit-user-basic', ['language' => app()->getLocale(), 'id' => $user->id]) }}" @else action="{{ route('user-add-basic', app()->getLocale()) }}" @endif enctype="multipart/form-data">@csrf
                <div class="form-row">
                    <div class="form-group col-lg-5">
                        <label for="first_name">First name *</label>
                        <input required name="first_name" type="text" class="form-control" id="first_name" value="{{$user->first_name ??''}}" @if($user) disabled @endif>
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="middle_name">Middle name</label>
                        <input name="middle_name" type="text" class="form-control" id="middle_name" value="{{$user->middle_name ??''}}" @if($user) disabled @endif>
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="rule_id">Role</label>
                        <span name="rule_id" type="text" class="form-control" id="rule_id" @if($user) disabled @endif>@switch($user->rule_id) @case(1)Visitor @break @case(2)Student @break @case(3)Teacher @break @case(4)Superadmin @break @case(5)Dev_User @endswitch</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-lg-5">
                        <label for="last_name">Last name *</label>
                        <input required name="last_name" type="text" class="form-control" id="last_name" value="{{$user->last_name ??''}}" @if($user) disabled @endif>
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="nickname">Nick name</label>
                        <input name="nickname" type="text" class="form-control" id="nickname" value="{{$user->nickname ??''}}" @if($user) disabled @endif>
                    </div>
                    <div class="form-group col-lg-2">
						<label for="language_code">Language *</label>
						<select required name="language_code" id="language_code" class="form-control" @if($user) disabled @endif>
							<option value="" disabled hidden selected>Please select a language</option>
							<option value="de" @if($user) @if($user->language_code == 'de') selected @endif @endif>German</option>
							<option value="en" @if($user) @if($user->language_code == 'en') selected @endif @endif>English</option>
						</select>
					</div>
                </div>

                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="email">E-Mail *</label>
                        <input required name="email" type="text" class="form-control" id="email" value="{{$user->email ??''}}" @if($user) disabled @endif>
                    </div>
                    <div class="form-group col-lg-4">
						<label for="user_status">Status</label>
						<select name="user_status" id="user_status" class="form-control" @if($user) disabled @endif>
							<option value="">Please select a status</option>
							<option value="Phone" @if($user) @if($user->user_status == 'Phone') selected @endif @endif>Phone completed</option>
							<option value="Error" @if($user) @if($user->user_status == 'Error') selected @endif @endif>Error with import</option>
						</select>
					</div>
                    <div class="form-group col-lg-2">
                        <label for="status">Language *</label>
                        <select required name="status" id="status" class="form-control" @if($user) disabled @endif>
                            <option value="1" @if($user) @if($user->status == '1') selected @endif @endif>Active</option>
                            <option value="2" @if($user) @if($user->status == '2') selected @endif @endif>Inactive</option>
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



	<div class="card rounded mb-5">
		<div class="card-header">

			<ul class="nav nav-tabs card-header-tabs justify-content-center" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active show" id="contact-information-tab" data-toggle="tab" href="#contactInformation" role="tab"
					   aria-controls="contactInformation" aria-selected="true">Contact Information</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="personal-information-tab" data-toggle="tab" href="#personalInformation" role="tab"
					   aria-controls="personalInformation" aria-selected="false">Personal Information</a>
				<li class="nav-item">
					<a class="nav-link" id="spiritual-history-tab" data-toggle="tab" href="#spiritualHistory" role="tab" aria-controls="spiritualHistory"
					   aria-selected="false">Spiritual History</a>
				</li>
			</ul>
		</div>


		<div class="tab-content p-0" id="myTabContent">
			<div class="tab-pane fade active show" id="contactInformation" role="tabpanel" aria-labelledby="contact-information-tab">
				<div class="row">
					<div class="col-lg-8 pr-0">
						<div class="card-body">
							<form id="contact-information-form" class="enable-able-form" action="{{ route('edit-user-contact', ['language' => app()->getLocale(), 'id' => $user->id]) }}" method="post"> @csrf
								<div class="form-row">
									<div class="form-group col-lg-9">
										<label for="address_street">Street</label>
										<input disabled id="address_street" name="address_street" type="text" class="form-control  @error('address_street') is-invalid @enderror" value="{{$user->contactInformation->address_street ??''}}"> @error('address_street')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
									</div>
									<div class="form-group col-lg-3">
										<label for="address_no">House No</label>
										<input disabled id="address_no" name="address_no" type="text" class="form-control @error('address_no') is-invalid @enderror" value="{{$user->contactInformation->address_no ??''}}"> @error('address_no')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-lg-12">
										<label for="address_supplements">Supplements</label>
										<input disabled id="address_supplements" name="address_supplements" type="text" class="form-control  @error('address_supplements') is-invalid @enderror" value="{{$user->contactInformation->address_supplements ??''}}"> @error('address_street')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-lg-5">
										<label for="zip">Zip</label>
										<input disabled id="zip" name="zip" type="text" class="form-control  @error('zip') is-invalid @enderror" value="{{$user->contactInformation->zip ??''}}"> @error('zip')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
									</div>
									<div class="form-group col-lg-7">
										<label for="city">City</label>
										<input disabled id="city" name="city" type="text" class="form-control  @error('city') is-invalid @enderror" value="{{$user->contactInformation->city ??''}}"> @error('city')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-lg-6">
										<label for="country">Country</label>
										<input disabled id="country" name="country" type="text" class="form-control  @error('country') is-invalid @enderror" value="{{$user->contactInformation->country ??''}}"> @error('country')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
									</div>
									<div class="form-group col-lg-6">
										<label for="state">Country</label>
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
					<div class="col-lg-4 pl-0" style="border-left: 1px solid lightgray;">
						<div class="card-body">
							<label>List of Phone numbers</label>
							<ul class="list-group">
								@foreach($user->phoneNumbers as $number)
								<li class="list-group-item bg-light">{{$number->country_code ??''}} {{$number->city_code ??''}} {{$number->phone_number ??''}}
                                    @switch($number->type_of_phone) @case(1)(Private) @break @case(2)(Office) @break @case(3)(Mobile) @break @case(4)(Fax) @break @case(5)(Other) @endswitch

                                    <a href="{{ route('user-phone-edit', ['language' => app()->getLocale(), 'id' => $number->id]) }}" class="float-right"><i class="fad fa-pen"></i></a>

                                </li>
								@endforeach
							</ul>
							@if($user)
							<div class="form-group mt-4">
                                <button type="button" data-toggle="modal" data-target="#modal_new_phone" class="btn btn-outline-success btn-header">New Phone Number</button>
							</div>
							@endif

						</div>
					</div>
				</div>
			</div>

			<div class="tab-pane fade" id="personalInformation" role="tabpanel" aria-labelledby="contact-information-tab">
				<div class="card-body">
					<form id="personal-information-form" class="enable-able-form" action="{{ route('edit-user-personal', ['language' => app()->getLocale(), 'id' => $user->id]) }}" method="post"> @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-3">
                                <label for="date_of_birth">Date of Birth</label>
                                <input disabled id="date_of_birth" name="date_of_birth" type="text" class="form-control  @error('date_of_birth') is-invalid @enderror" value="{{$user->personalInformation->date_of_birth ??''}}"> @error('date_of_birth')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="time_of_birth">Time of Birth</label>
                                <input disabled id="time_of_birth" name="time_of_birth" type="text" class="form-control  @error('time_of_birth') is-invalid @enderror" value="{{$user->personalInformation->time_of_birth ??''}}"> @error('time_of_birth')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="state">Place of Birth</label>
                                <input disabled id="place_of_birth" name="place_of_birth" type="text" class="form-control  @error('place_of_birth') is-invalid @enderror" value="{{$user->personalInformation->place_of_birth ??''}}"> @error('place_of_birth')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-3">
                                <label for="gender">Gender</label>
                                <input disabled id="gender" name="country" class="form-control  @error('gender') is-invalid @enderror" value="{{$user->personalInformation->gender ??''}}"> @error('gender')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="married">Married</label>
                                <input disabled id="married" name="married" class="form-control  @error('married') is-invalid @enderror" value="{{$user->personalInformation->married ??''}}"> @error('married')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
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
                                <input type="hidden" name="user_id" value="{{$user->id}}">
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
							<div class="form-group col-lg-12">
								<label for="first_meet">First Meet</label>
								<input disabled id="first_meet" name="first_meet" class="form-control  @error('first_meet') is-invalid @enderror" value="{{$user->spiritualHistory->first_meet ??''}}">
								@error('first_meet')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
							</div>

						</div>

						<div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="events_kaleshwar">Events with Sri Kaleshwar</label>
                                <textarea id="events_kaleshwar" name="events_kaleshwar" class="form-control @error('events_kaleshwar') is-invalid @enderror" rows="5" disabled="">{{$user->spiritualHistory->events_kaleshwar ??''}}</textarea>
                                @error('events_kaleshwar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="processes_kaleshwar">Meditation processes from Sri Kaleshwar</label>
                                <textarea id="processes_kaleshwar" name="processes_kaleshwar" class="form-control @error('processes_kaleshwar') is-invalid @enderror" rows="5" disabled="">{{$user->spiritualHistory->processes_kaleshwar ??''}}</textarea>
                            	@error('processes_kaleshwar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
							</div>
                        </div>
						<div class="form-row">
							<div class="form-group col-sm-6 col-lg-2">
								<label for="ashram_visited">Ever visited Ashram </label>
								<select name="ashram_visited" id="ashram_visited" class="form-control" @if($user) disabled @endif>
									<option value="">Please select</option>
									<option value="2" @if($user) @if($user->spiritualHistory && $user->spiritualHistory->ashram_visited == '2') selected @endif @endif>No</option>
									<option value="1" @if($user) @if($user->spiritualHistory && $user->spiritualHistory->ashram_visited == '1') selected @endif @endif>Yes</option>
								</select>
							</div>
							<div class="form-group col-sm-6 col-lg-2">
								<label for="attend_ie2011">Attended IE 2011</label>
								<select name="attend_ie2011" id="attend_ie2011" class="form-control" hidden @if($user) disabled @endif>
									<option value="">Please select</option>
									<option value="2" @if($user) @if($user->spiritualHistory && $user->spiritualHistory->attend_ie2011 == '2') selected @endif @endif>No</option>
									<option value="1" @if($user) @if($user->spiritualHistory && $user->spiritualHistory->attend_ie2011 == '1') selected @endif @endif>Yes</option>
								</select>
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
		</div>
	</div>
</div>

@endsection
