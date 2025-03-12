
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
                    @empty(!$organizer)
                        <div class="card-header">
                            <div class="row">
                                <div class="col mr-auto">
                                    <h5 class="backend-title mt-2">Edit {{ucfirst($organizer->type)}} :: {{$organizer->organizer_name}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                        <div class="col-md-3 p-0">
                            <div class="card-body px-0 py-4">
                                <div class="nav flex-column nav-pills text-center text-md-left" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                                    <a class="nav-link active show" id="basic-data-tab" data-toggle="tab" href="#basic-data-Form" role="tab" aria-controls="basic-data-Tab" aria-selected="true">{{$organizer->type === 'group' ? 'Group' : 'Teacher'}} base data</a>
                                    <a class="nav-link" id="contact-data-tab" data-toggle="tab" href="#contact-data-Form" role="tab" aria-controls="contact-data-Tab" aria-selected="true">{{$organizer->type === 'group' ? 'Group' : 'Teacher'}} address data</a>
                                    <a class="nav-link" id="phone-numbers-tab" data-toggle="tab" href="#phone-numbers-Form" role="tab" aria-controls="phone-numbers-Tab" aria-selected="true">Phone numbers</a>
                                    <a class="nav-link mb-2" id="topics-tab" data-toggle="tab" href="#topics-Form" role="tab" aria-controls="topics-Tab" aria-selected="true">{{ __('teachers.topics_teachings') }}</a>

                                    @foreach($organizer->organizerDetails as $organizerDetail)
                                        <a class="nav-link" id="{{$organizerDetail->language}}-tab" data-toggle="tab" href="#{{$organizerDetail->language}}Form" role="tab" aria-controls="{{$organizerDetail->language}}Tab" aria-selected="true">{{ucfirst($organizer->type)}} details: {{__('login.language.' . $organizerDetail->language)}}</a>
                                    @endforeach
                                    <a class="nav-link" href="{{route('organizer-add-translation', ['language' => app()->getLocale(), 'id' => $organizer->id]) }}">@isset($organizer->organizerDetails[0]) Add Translation @else Add {{ucfirst($organizer->type)}} Details @endisset </a>

                                    @if(auth()->user()->rule_id == 4)
                                        <span class="nav-link mt-3">>>> Administration</span>
                                        <a class="nav-link mb-2" id="certifications-tab" data-toggle="tab" href="#certifications-Form" role="tab" aria-controls="certifications-Tab" aria-selected="true">Certifications</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 p-0">
                            <div class="user-account-section p-0">
                                <div class="tab-content p-0" id="myTabContent">
                                    <div class="tab-pane fade active show" id="basic-data-Form" role="tabpanel" aria-labelledby="basic-data-tab">
                                        <div class="card-body">
                                            <form id="edit-organizer-basic-form" class="enable-able-form" action="{{ route('organizer-edit', ['language' => app()->getLocale(), 'id' => $organizer->id]) }}" method="post">@csrf
                                                <div class="button-bar">
                                                    <button disabled hidden type="submit" class="btn btn-outline-success submit-button mx-1">Save</button>
                                                    <button type="button" class="btn btn-outline-secondary edit-button mx-1">Edit</button>
                                                    <button onclick="window.location.href = '{{ route('organizer-list', ['language' => app()->getLocale(), 'type' => $organizer->type]) }}';" type="button" class="btn btn-outline-dark mx-1">Back</button>
                                                    @if(auth()->user()->rule_id == 4)
                                                        <a onclick="return confirm('Do you sure you want send tutorial message?');" href="{{ route('send-message-tutorial', ['language' => app()->getLocale(), 'id' => $organizer->id]) }}" class="btn btn-outline-success btn-header">Send Tutorial</a>
                                                    @endif
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-9">
                                                        <label for="organizer_name">Name *</label>
                                                        <input disabled id="organizer_name" name="organizer_name" class="form-control" maxlength="30" value="{{$organizer->organizer_name}}" required>
                                                        @error('organizer_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="is_visible">Profile is visible</label>
                                                        <select required name="is_visible" id="is_visible" class="form-control @if($organizer->is_visible == '0') border-danger @else border-success @endif" disabled>
                                                            <option value="1" @if($organizer && $organizer->is_visible == '1') selected @endif>Yes</option>
                                                            <option value="0" @if($organizer && $organizer->is_visible == '0') selected @endif>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-9">
                                                        <label for="organizer_email">Contact E-Mail of {{ trans_choice('app.'.$organizer->type, 1) }} *</label>
                                                        <input disabled id="organizer_email" name="organizer_email" class="form-control" maxlength="190" type="email" value="{{$organizer->organizer_email}}" required>
                                                        @error('organizer_email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="status">Account status</label>
                                                        @if(auth()->user()->rule_id == 4)
                                                            <select required name="status" id="status" class="form-control" disabled>
                                                                <option value="1" @if($organizer && $organizer->status == '1') selected @endif>Active</option>
                                                                <option value="2" @if($organizer && $organizer->status == '2') selected @endif>Inactive</option>
                                                                <option value="3" @if($organizer && $organizer->status == '3') selected @endif>Blocked</option>
                                                                <option value="4" @if($organizer && $organizer->status == '4') selected @endif>Internal</option>
                                                            </select>
                                                        @else
                                                            <span class="form-control">{{$organizer->status_name}}</span>
                                                            @if(auth()->user()->rule_id == 3 && $organizer->status == '2')
                                                                <input hidden name="status" id="status" value="1">
                                                            @else
                                                                <input hidden name="status" id="status" value="{{$organizer->status}}">
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-9">
                                                        <label for="organizer_website">Website of {{ trans_choice('app.'.$organizer->type, 1) }}</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">https://</span>
                                                            </div>
                                                            <input disabled id="organizer_website" name="organizer_website" class="form-control col-10" maxlength="190" type="text" value="{{$organizer->organizer_website}}">
                                                            @error('organizer_website')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>
                                                    </div>
                                                </div>


                                                @if(auth()->user()->rule_id == 4)

                                                    <hr>

                                                    <div class="form-row">
                                                        <div class="form-group col-md-5">
                                                            <span class="form-control">{{$organizer->admin->first_name}} {{$organizer->admin->last_name}}</span>
                                                        </div>
                                                        <div class="form-group col-md-5">
                                                            <span class="form-control">{{$organizer->admin->email}}</span>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <span class="form-control">{{$organizer->admin->language_code}}</span>
                                                        </div>
                                                    </div>
                                                @endif

                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="contact-data-Form" role="tabpanel" aria-labelledby="contact-data-tab">
                                        <div class="card-body">
                                            <form id="edit-organizer-contact-form" class="enable-able-form" action="{{ route('organizer-contact-edit', ['language' => app()->getLocale(), 'id' => $organizer->id]) }}" method="post">@csrf
                                                <div class="button-bar">
                                                    <button disabled hidden type="submit" class="btn btn-outline-success submit-button mx-1">Save</button>
                                                    <button type="button" class="btn btn-outline-secondary edit-button mx-1">Edit</button>
                                                    <button onclick="window.location.href = '{{ route('organizer-list', ['language' => app()->getLocale(), 'type' => $organizer->type]) }}';" type="button" class="btn btn-outline-dark mx-1">Back</button>
                                                </div>

                                                <input hidden name="organizer_id" value="{{$organizer->id}}">

                                                <div class="form-row">
                                                    <div class="form-group col-lg-9">
                                                        <label for="address_street">Street</label>
                                                        <input id="address_street" name="address_street" type="text" class="form-control" value="{{$organizer->organizerContactInformation->address_street ??''}}" disabled>
                                                    </div>
                                                    <div class="form-group col-lg-3">
                                                        <label for="address_no">House No</label>
                                                        <input id="address_no" name="address_no" type="text" class="form-control" value="{{$organizer->organizerContactInformation->address_no ??''}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-12">
                                                        <label for="address_supplements">Supplements</label>
                                                        <input id="address_supplements" name="address_supplements" type="text" class="form-control" value="{{$organizer->organizerContactInformation->address_supplements ??''}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-7">
                                                        <label for="city">City *</label>
                                                        <input disabled id="city" name="city" type="text" required class="form-control" value="{{$organizer->organizerContactInformation->city ??''}}"> @error('city')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <label for="zip">Zip</label>
                                                        <input disabled id="zip" name="zip" type="text" class="form-control  @error('zip') is-invalid @enderror" value="{{$organizer->organizerContactInformation->zip ??''}}"> @error('zip')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-6">
                                                        <label for="country">Country *</label>
                                                        <select disabled id="country" name="country" required class="form-control @error('country') is-invalid @enderror">
                                                            @foreach(__('countries') as $key => $value)
                                                                <option value="{{$key}}" @if($organizer->organizerContactInformation && $organizer->organizerContactInformation->country == $key) selected @endif>{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('country')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="state">State</label>
                                                        <input disabled id="state" name="state" type="text" class="form-control  @error('state') is-invalid @enderror" value="{{$organizer->organizerContactInformation->state ??''}}"> @error('country')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="phone-numbers-Form" role="tabpanel" aria-labelledby="phone-numbers-tab">
                                        <div class="card-body">
                                            <label>List of Phone numbers</label>

                                            <div class="col-12 bg-light border-bottom p-0 collapse" id="card_new_phone" style="">
                                                <div class="card-body pb-0">
                                                    <form class="new-phone-form" method="post" action="{{ route('organizer-add-phone', ['language' => app()->getLocale(), 'id' => $organizer->id]) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-row">
                                                            <div class="form-group col-sm-4">
                                                                <label for="country_code">Country Code *</label>
                                                                <input required="" id="country_code" name="country_code" type="text" placeholder="e.g. 0091" maxlength="7" value="" class="form-control floatNumber bg-white">
                                                            </div>
                                                            <div class="form-group col-sm-8">
                                                                <label for="phone_number">Phone Number *</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">(0)</span>
                                                                    </div>
                                                                    <input required id="phone_number" name="phone_number" type="text" placeholder="e.g. 180-220006" min="190" value="" class="form-control floatNumber bg-white">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-12">
                                                                <label for="type_of_phone">Phone Type *</label>
                                                                <select required="" name="type_of_phone" id="type_of_phone" class="form-control bg-white">
                                                                    <option value="" selected="">Please select</option>
                                                                    <option value="1">Private</option>
                                                                    <option value="2">Office</option>
                                                                    <option value="3">Mobile</option>
                                                                    <option value="4">Other</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-row pb-0 mt-2">
                                                            <div class="form-group">
                                                                <input type="hidden" name="id" id="id" value="">
                                                                <button type="submit" class="btn btn-primary submit-button btn-header">Save</button>
                                                                <button type="button" id="close-phone-section" data-target="#card_new_phone" class="btn btn-dark btn-header ml-2">Close</button>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="color-gray">* These fields are required</label>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <ul class="list-group">
                                                @foreach($organizer->organizerPhoneNumbers as $number)
                                                    <li class="list-group-item bg-light">
                                                        {{$number->country_code ??''}} {{$number->phone_number ??''}}
                                                        <span class="text-muted text-small">({{$number->type_of_phone_name ??''}})</span>
                                                        <span class="float-right">
                                                            <a class="click-for-edit-phone" data-target="#card_new_phone" data-value="{{$number}}"><i class="fad fa-pen"></i></a>
                                                            <a onclick="return confirm('Do you sure you want delete that phone number?');" href="{{ route('delete-organizer-phone', ['language' => app()->getLocale(), 'id' => $number->id]) }}"><i class="fad fa-eraser"></i></a>
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="form-group mt-4">
                                                <button type="button" data-toggle="collapse" data-target="#card_new_phone" class="btn btn-outline-success btn-header">New Phone Number</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="certifications-Form" role="tabpanel" aria-labelledby="certifications-tab">
                                        <div class="card-body">
                                            <form id="organizer-certifications-form" class="enable-able-form" action="{{ route('organizer-change-certifications', ['language' => app()->getLocale(), 'id' => $organizer->id]) }}" method="post">@csrf
                                                <div class="button-bar">
                                                    <button disabled hidden type="submit" class="btn btn-outline-success submit-button mx-1">Save</button>
                                                    <button type="button" class="btn btn-outline-secondary edit-button mx-1">Edit</button>
                                                    <button onclick="window.location.href = '{{ route('organizer-list', ['language' => app()->getLocale(), 'type' => $organizer->type]) }}';" type="button" class="btn btn-outline-dark mx-1">Back</button>
                                                </div>

                                                <h5>Certifications</h5>
                                                <div class="row">
                                                    @foreach($topics as $topic)
                                                        @if($topic->certification == 1)
                                                            <div class="col-4 my-2">
                                                                <div class="form-check">
                                                                    <input @if($organizer->certifications->contains($topic->id)) checked @endif type="checkbox" disabled class="form-check-input" id="certifications-{{$topic->id}}" name="certifications[{{$topic->id}}]">
                                                                    <label class="form-check-label" for="certifications-{{$topic->id}}">{{$topic->name}}</label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="topics-Form" role="tabpanel" aria-labelledby="topics-tab">
                                        <div class="card-body">
                                            <form id="organizer-topic-form" class="enable-able-form" action="{{ route('organizer-change-topics', ['language' => app()->getLocale(), 'id' => $organizer->id]) }}" method="post">@csrf
                                                <div class="button-bar">
                                                    <button disabled hidden type="submit" class="btn btn-outline-success submit-button mx-1">Save</button>
                                                    <button type="button" class="btn btn-outline-secondary edit-button mx-1">Edit</button>
                                                    <button onclick="window.location.href = '{{ route('organizer-list', ['language' => app()->getLocale(), 'type' => $organizer->type]) }}';" type="button" class="btn btn-outline-dark mx-1">Back</button>
                                                </div>
                                                <h5>Topics</h5>
                                                <div class="row">
                                                    @foreach($topics as $topic)
                                                        @if($topic->certification == 0)
                                                            <div class="col-4 my-2">
                                                                <div class="form-check">
                                                                    <input @if(in_array($topic->id, $organizer->topic_ids)) checked @endif type="checkbox" disabled class="form-check-input" id="topic-{{$topic->id}}" name="topics[{{$topic->id}}]">
                                                                    <label class="form-check-label" for="topic-{{$topic->id}}">{{$topic->name}}</label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>

                                                <hr>

                                                <h5>Teachings</h5>
                                                <div class="row">
                                                    @foreach($organizer->certifications as $teaching)
                                                        @if($teaching->certification == 1)
                                                            <div class="col-4 my-2">
                                                                <div class="form-check">
                                                                    @if($organizer->type == 'teacher')
                                                                        <input @if(in_array($teaching->id, $organizer->topic_ids)) checked @endif type="checkbox" disabled class="form-check-input" id="topic-{{$teaching->id}}" name="topics[{{$teaching->id}}]">
                                                                    @endif
                                                                    <label class="form-check-label" for="topic-{{$teaching->id}}">{{$teaching->name}}</label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                    @foreach($organizer->organizerDetails as $organizerDetail)
                                        <div class="tab-pane fade" id="{{$organizerDetail->language}}Form" role="tabpanel" aria-labelledby="{{$organizerDetail->language}}-tab">
                                            <form id="edit-event-form-{{$organizerDetail->language}}" class="enable-able-form" action="{{ route('organizer-details-edit', ['language' => app()->getLocale(), 'id' => $organizerDetail->id]) }}" method="post">@csrf
                                                <div class="button-bar">
                                                    <button type="button" class="btn btn-outline-secondary edit-button">Edit</button>
                                                    <button disabled hidden type="submit" class="btn btn-outline-success submit-button">Save</button>
                                                    <button onclick="window.location.href = '{{ route('organizer-list', ['language' => app()->getLocale(), 'type' => $organizer->type]) }}';" type="button" class="btn btn-outline-dark">Back</button>
                                                </div>
                                                <div class="card-body">
                                                    <input id="language" name="language" hidden type="text" value="{{$organizerDetail->language}}">

{{--                                                    <div class="form-row">--}}
{{--                                                        <div class="form-group col-lg-12">--}}
{{--                                                            <label for="introduction">Introduction *</label>--}}
{{--                                                            <textarea disabled id="introduction" name="introduction" class="form-control" rows="2" maxlength="130" required>{{$organizerDetail->introduction}}</textarea>--}}
{{--                                                            @error('introduction')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
                                                    <div class="form-row">
                                                        <div class="form-group col-lg-12">
                                                            <label for="description">Description</label>
                                                            <div height="auto" readonly class="form-div-control show_tinymce">{!! $organizerDetail->description !!}</div>
                                                            <textarea disabled id="description" name="description" rows="5" class="form-control edit_tinymce d-none">{!! $organizerDetail->description !!}</textarea>
                                                            @error('description')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                    @else
                        <div class="card-body">
                            {{ __('app.no_data_found') }}
                        </div>
                    @endempty
                </div>

            </div>
        </div>
    </div>
@endsection
