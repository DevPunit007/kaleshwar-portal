{{-- Form for the spirituel information in iframe.user account and user.edit in admin console --}}
<div class="form-row">
    <div class="form-group col-sm-8">
        <label for="first_meet">{{ __('iframe-user-account.first-meet-kaleshwar') }}</label>
        <textarea id="first_meet" name="first_meet" class="form-control" maxlength="60" rows="1" disabled>{{$spiritualHistory->first_meet ??''}}</textarea>
    </div>
    <div class="form-group col-sm-4">
        <label for="ashram_visited">{{ __('iframe-user-account.ashram-visited') }}</label>
        <select name="ashram_visited" id="ashram_visited" class="form-control" disabled>
            <option value="">{{ __('iframe-user-account.please-select') }}</option>
            <option value="1" @if($spiritualHistory && $spiritualHistory->ashram_visited == '1') selected @endif>{{ __('iframe-user-account.yes') }}</option>
            <option value="2" @if($spiritualHistory && $spiritualHistory->ashram_visited == '2') selected @endif>{{ __('iframe-user-account.no') }}</option>
        </select>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-12">
        <label for="events_kaleshwar">{{ __('iframe-user-account.which-courses-attended') }}</label>
        <textarea id="events_kaleshwar" name="events_kaleshwar" class="form-control" rows="3" disabled>{{$spiritualHistory->events_kaleshwar ??''}}</textarea>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-12">
        <label for="processes_kaleshwar">{{ __('iframe-user-account.which-meditation-completed') }}</label>
        <textarea id="processes_kaleshwar" name="processes_kaleshwar" class="form-control" rows="3" disabled>{{$spiritualHistory->processes_kaleshwar ??''}}</textarea>
    </div>
</div>

<input type="hidden" name="id" value="{{$user->id}}">
