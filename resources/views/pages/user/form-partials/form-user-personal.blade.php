{{-- Form for the basic information in iframe.user account and user.edit in admin console --}}
<div class="form-row">
    <div class="form-group col-lg-3">
        <label for="date_of_birth">{{ __('iframe-user-account.birth-date') }}</label>
        <input disabled id="date_of_birth" name="date_of_birth" type="date" class="form-control" value="@if($user->personalInformation){{$user->personalInformation->date_of_birth ??''}}@endif">
    </div>
    <div class="form-group col-lg-3">
        <label for="time_of_birth">{{ __('iframe-user-account.birth-time') }}</label>
        <input disabled id="time_of_birth" name="time_of_birth" type="time" class="form-control" value="@if($user->personalInformation && $user->personalInformation->time_of_birth){{\Carbon\Carbon::createFromFormat('H:i:s', ($user->personalInformation->time_of_birth))->format('H:i')}}@endif">
    </div>
    <div class="form-group col-lg-6">
        <label for="place_of_birth">{{ __('iframe-user-account.birth-place') }}</label>
        <input disabled id="place_of_birth" name="place_of_birth" type="text" class="form-control" value="{{$user->personalInformation->place_of_birth ??''}}">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-6 col-lg-3">
        <label for="gender">{{ __('iframe-user-account.gender') }}</label>
        <select name="gender" id="gender" class="form-control" disabled>
            <option value="">{{ __('iframe-user-account.please-select') }}</option>
            <option value="1" @if($user->personalInformation && $user->personalInformation->gender == '1') selected @endif>{{ __('iframe-user-account.male') }}</option>
            <option value="2" @if($user->personalInformation && $user->personalInformation->gender == '2') selected @endif>{{ __('iframe-user-account.female') }}</option>
        </select>
    </div>
    <div class="form-group col-6 col-lg-3">
        <label for="married">{{ __('iframe-user-account.married') }}</label>
        <select name="married" id="married" class="form-control" disabled>
            <option value="">{{ __('iframe-user-account.please-select') }}</option>
            <option value="1" @if($user->personalInformation && $user->personalInformation->married == '1') selected @endif>{{ __('iframe-user-account.yes') }}</option>
            <option value="2" @if($user->personalInformation && $user->personalInformation->married == '2') selected @endif>{{ __('iframe-user-account.no') }}</option>
        </select>
    </div>
    <div class="form-group col-lg-6">
        <label for="name_of_spouse">{{ __('iframe-user-account.name-spouse') }}</label>
        <input disabled id="name_of_spouse" name="name_of_spouse" class="form-control" value="{{$user->personalInformation->name_of_spouse ??''}}"> @error('name_of_spouse')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group col-lg-5">
        <label for="name_of_father">{{ __('iframe-user-account.name-father') }}</label>
        <input disabled id="name_of_father" name="name_of_father" class="form-control" value="{{$user->personalInformation->name_of_father ??''}}"> @error('name_of_father')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="form-group col-lg-5">
        <label for="name_of_mother">{{ __('iframe-user-account.name-mother') }}</label>
        <input disabled id="name_of_mother" name="name_of_mother" class="form-control" value="{{$user->personalInformation->name_of_mother ??''}}"> @error('name_of_mother')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="form-group col-lg-2">
        <label for="born_as_nth">{{ __('iframe-user-account.which-child') }}</label>
        <input disabled id="born_as_nth" name="born_as_nth" class="form-control" value="{{$user->personalInformation->born_as_nth ??''}}" type="number" min="1" max="18">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-lg-8">
        <label for="profession">{{ __('iframe-user-account.profession') }}</label>
        <input disabled id="profession" name="profession" class="form-control" value="{{$user->personalInformation->profession ??''}}"> @error('profession')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<input type="hidden" name="id" value="{{$user->id}}">

