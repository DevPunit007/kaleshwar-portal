{{-- Form for the phone list in iframe.user account and user.edit in admin console --}}
<div class="col-12 collapse bg-light border-bottom p-0" id="card_new_phone">
    <div class="card-body pb-0">
        <form class="new-phone-form" method="post" action="{{ route('add-user-phone', app()->getLocale()) }}" enctype="multipart/form-data">@csrf
            <div class="form-row">
                <div class="form-group col-sm-4">
                    <label for="country_code">{{ __('iframe-user-account.country-code') }} *</label>
                    <input required id="country_code" name="country_code" type="text" placeholder="e.g. 0091"  maxlength="7" value="" class="form-control floatNumber bg-white">
                </div>
                <div class="form-group col-sm-8">
                    <label for="phone_number">{{ __('iframe-user-account.phone-number') }} *</label>
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
                    <label for="type_of_phone">{{ __('iframe-user-account.phone-type') }} *</label>
                    <select required name="type_of_phone" id="type_of_phone" class="form-control bg-white">
                        <option value="" selected>{{ __('iframe-user-account.please-select') }}</option>
                        <option value="1">{{ __('iframe-user-account.private') }}</option>
                        <option value="2">{{ __('iframe-user-account.office') }}</option>
                        <option value="3">{{ __('iframe-user-account.mobile') }}</option>
                        <option value="4">{{ __('iframe-user-account.other') }}</option>
                    </select>
                </div>
            </div>
            <div class="form-row pb-0 mt-2">
                <div class="form-group">
                   <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                    <button type="submit" class="btn btn-primary submit-button btn-header">{{ __('iframe-user-account.save') }}</button>
                    <button type="button" id="close-phone-section" data-target="#card_new_phone" class="btn btn-dark btn-header ml-2">{{ __('iframe-user-account.close') }}</button>
                </div>
                <div class="form-group">
                    <label class="color-gray">* {{ __('iframe-user-account.field_required') }}</label>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="col-lg-6 p-0">
    <div class="card-body">
        <h6 class="mb-3">{{ __('iframe-user-account.list-phone-numbers') }}</h6>
        <ul class="list-group list-scroll">
            @foreach($phoneNumbers as $number)
                <li class="list-group-item bg-light">
                    {{$number->country_code ??''}} {{$number->phone_number ??''}}
                    <span class="text-muted text-small">({{$number->type_of_phone_name ??''}})</span>
                    <span class="float-right">
                        <a class="click-for-edit-phone" data-target="#card_new_phone" data-value="{{$number}}"><i class="fad fa-pen"></i></a>
                        <a onclick="return confirm('Do you sure you want delete that phone number?');" href="{{ route('delete-user-phone', ['language' => app()->getLocale(), 'id' => $number->id]) }}"><i class="fad fa-eraser"></i></a>
                    </span>
                </li>
            @endforeach
        </ul>
        @hasSection('button')
            @yield('button')
            @endif

    </div>
</div>


