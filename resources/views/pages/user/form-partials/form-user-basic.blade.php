{{-- Form for the basic information in iframe.user account and user.edit in admin console --}}
<div class="form-row">
    <div class="form-group col-lg-6">
        <label for="first_name">{{ __('iframe-user-account.first-name') }} *</label>
        <input required name="first_name" type="text" class="form-control" id="first_name" value="{{$user->first_name ??''}}" disabled>
    </div>
    <div class="form-group col-lg-6">
        <label for="middle_name">{{ __('iframe-user-account.middle-name') }}</label>
        <input name="middle_name" type="text" class="form-control" id="middle_name" value="{{$user->middle_name ??''}}" disabled>
    </div>

</div>
<div class="form-row">
    <div class="form-group col-lg-6">
        <label for="last_name">{{ __('iframe-user-account.last-name') }} *</label>
        <input required name="last_name" type="text" class="form-control" id="last_name" value="{{$user->last_name ??''}}" disabled>
    </div>
    <div class="form-group col-lg-6">
        <label for="nickname">{{ __('iframe-user-account.nick-indian-name') }}</label>
        <input name="nickname" type="text" class="form-control" id="nickname" value="{{$user->nickname ??''}}" disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-lg-7">
        <label for="email">{{ __('iframe-user-account.e-mail') }} *</label>
        <input name="email" type="text" class="form-control" id="email" value="{{$user->email ??''}}" disabled @if(auth()->user()['rule_id'] < 3) readonly @endif>
    </div>
    <div class="form-group col-lg-3">
        <label for="language_code">{{ __('iframe-user-account.language') }} *</label>
        <select required name="language_code" id="language_code" class="form-control" disabled>
            <option value="">{{ __('iframe-user-account.please-select') }}</option>

            <option value="en" @if($user) @if($user->language_code == 'en') selected @endif @endif>English</option>
            <option value="de" @if($user) @if($user->language_code == 'de') selected @endif @endif>Deutsch</option>
            <option value="jp" @if($user) @if($user->language_code == 'jp') selected @endif @endif>日本語</option>
            <option value="cz" @if($user) @if($user->language_code == 'cz') selected @endif @endif>Čeština</option>
        </select>
    </div>

    <div class="form-group col-lg-2">
        <label for="newsletter">{{ __('iframe-user-account.newsletter') }}</label>
        <select required name="newsletter" id="newsletter" class="form-control @isset($user->ashramData->newsletter) @if($user->ashramData->newsletter < '1') border-danger @endif @endisset" disabled>
            <option value="@if(auth()->user()['rule_id'] > 2) 0 @endif">{{ __('iframe-user-account.select') }}</option>
            <option value="1" @isset($user->ashramData->newsletter) @if($user->ashramData->newsletter == '1') selected @endif @endisset>{{ __('iframe-user-account.yes') }}</option>
            <option value="2" @isset($user->ashramData->newsletter) @if($user->ashramData->newsletter == '2') selected @endif @endisset>{{ __('iframe-user-account.no') }}</option>
        </select>
    </div>
</div>


