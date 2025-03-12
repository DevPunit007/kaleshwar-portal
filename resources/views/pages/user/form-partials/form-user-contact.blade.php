{{-- Form for the contact information in iframe.user account and user.edit in admin console --}}
<div class="form-row">
    <div class="form-group col-lg-9">
        <label for="address_street">{{ __('iframe-user-account.street') }}</label>
        <input id="address_street" name="address_street" type="text" class="form-control" value="{{$user->contactInformation->address_street ??''}}" disabled>
    </div>
    <div class="form-group col-lg-3">
        <label for="address_no">{{ __('iframe-user-account.house-no') }}</label>
        <input id="address_no" name="address_no" type="text" class="form-control" value="{{$user->contactInformation->address_no ??''}}" disabled>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-lg-12">
        <label for="address_supplements">{{ __('iframe-user-account.supplements') }}</label>
        <input id="address_supplements" name="address_supplements" type="text" class="form-control" value="{{$user->contactInformation->address_supplements ??''}}" disabled>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-lg-7">
        <label for="city">{{ __('iframe-user-account.city') }}</label>
        <input disabled id="city" name="city" type="text" class="form-control" value="{{$user->contactInformation->city ??''}}"> @error('city')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="form-group col-lg-5">
        <label for="zip">{{ __('iframe-user-account.zip') }}</label>
        <input disabled id="zip" name="zip" type="text" class="form-control  @error('zip') is-invalid @enderror" value="{{$user->contactInformation->zip ??''}}"> @error('zip')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>

</div>
<div class="form-row">
    <div class="form-group col-lg-6">
        <label for="country">{{ __('iframe-user-account.country') }}</label>
        <select disabled id="country" name="country" required class="form-control @error('country') is-invalid @enderror">
            @foreach(__('countries') as $key => $value)
                <option value="{{$key}}" @if($user->contactInformation && $user->contactInformation->country == $key) selected @endif>{{$value}}</option>
            @endforeach
        </select>
        @error('country')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>

    <div class="form-group col-lg-6">
        <label for="state">{{ __('iframe-user-account.state') }}</label>
        <input disabled id="state" name="state" type="text" class="form-control  @error('state') is-invalid @enderror" value="{{$user->contactInformation->state ??''}}"> @error('country')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<input type="hidden" name="id" value="{{$user->id}}">
