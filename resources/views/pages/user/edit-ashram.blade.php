@extends('pages.user.edit--frame')

@section('user-account')

<div class="col-md-9 p-0">
    <div class="user-account-section p-0">
        <form id="ashram-data-form" class="enable-able-form" action="{{ route('edit-user-ashram', ['language' => app()->getLocale(), 'id' => $user->id]) }}" method="post"> @csrf
            <div class="button-bar">
                <button type="button" class="btn btn-outline-secondary edit-button">Edit</button>
                <button disabled hidden type="submit" class="btn btn-outline-success submit-button">Save</button>
            </div>
            <div class="card-body">

                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="status">Account status</label>
                        <select required name="status" id="status" class="form-control" disabled>
                            <option value="1" @if($user && $user->status == '1') selected @endif>Active</option>
                            <option value="2" @if($user && $user->status == '2') selected @endif>Inactive</option>
                            <option value="3" @if($user && $user->status == '3') selected @endif>Blocked</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="user_status">Internal status</label>
                        <select name="user_status" id="user_status" class="form-control" disabled>
                            <option value=""></option>
                            <option value="email_missing" @if($ashramData && $ashramData->user_status == 'email_missing') selected @endif>Email missing Level 1</option>
                            <option value="email_missing_lv2" @if($ashramData && $ashramData->user_status == 'email_missing_lv2') selected @endif>Email missing Level 2</option>
                            <option value="email_missing_lv3" @if($ashramData && $ashramData->user_status == 'email_missing_lv3') selected @endif>Email missing Level 3</option>
                            <option value="duplikate" @if($ashramData && $ashramData->user_status == 'duplikate') selected @endif>Duplicate</option>
                            <option value="unknown" @if($ashramData && $ashramData->user_status == 'unknown') selected @endif>Unknown</option>
                            <option value="confirmed" @if($ashramData && $ashramData->user_status == 'confirmed') selected @endif>Confirmed</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="newsletter">Newsletter</label>
                        <select name="newsletter" id="newsletter" class="form-control" disabled>
                            <option value="0">Select</option>
                            <option value="1" @isset($ashramData->newsletter) @if($ashramData->newsletter == '1') selected @endif @endisset>Yes</option>
                            <option value="2" @isset($ashramData->newsletter) @if($ashramData->newsletter == '2') selected @endif @endisset>No</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="attend_ie2011">Attended IE 2011</label>
                        <select name="attend_ie2011" id="attend_ie2011" class="form-control" disabled>
                            <option value="1" @isset($ashramData->attend_ie2011) @if($ashramData->attend_ie2011 == '1') selected @endif @endisset>Yes</option>
                            <option value="2" @isset($ashramData->attend_ie2011) @if($ashramData->attend_ie2011 == '2') selected @endif @else selected @endisset>No</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="comments">Internal comments</label>
                        <textarea id="comments" name="comments" class="form-control" rows="4" disabled>{{$ashramData->comments ??''}}</textarea>
                    </div>
                </div>

                <input type="hidden" name="id" value="{{$user->id}}">

            </div>
        </form>
    </div>
</div>

@endsection
