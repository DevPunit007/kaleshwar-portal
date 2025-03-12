@extends('templates.default')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col mr-auto">
                        <h5 class="backend-title mt-2">List of {{ trans_choice('app.'.$type, 2) }}</h5>
                    </div>
                    <div class="col-auto text-right">
                        <span id="select-filter-table"></span>
{{--                        <button onclick="window.location.href = '{{ route('organizer-add', ['language' => app()->getLocale(), 'type' => 'teacher']) }}';"--}}
{{--                                type="button" class="btn btn-outline-success btn-header">Add Teacher</button>--}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table id="user-list-table" class="display">
                      <thead>
                      <tr>
                          <th class="table-icon"></th>
                          <th data-priority="1">Name</th>
                          <th>Admin E-Mail</th>
                          <th>Country</th>
                          <th>Visibility</th>
                          <th>Status</th>
                          <th class="d-none"></th>
                          <th>Current Events</th>
                          @if(auth()->user()->rule_id == 4)
                            <th>Certifications</th>
                            <th>#</th>
                          @endif
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($teachers as $teacher)
                          <tr>
                              <td class="nowrap table-icon">
                                  <i class="fas fa-chevron-circle-down fa-lg mx-1 color-green op-7"></i>
                                  <a href="{{ route('teacher-edit', ['language' => app()->getLocale(), 'id' => $teacher->id]) }}"><i class="fas fa-chevron-circle-right fa-lg mx-1 color-theme-dark op-7"></i></a>
                              </td>
                              <td>{{$teacher->organizer_name}}</td>
                              <td>@if($teacher->admin) <a href="mailto:{{$teacher->admin->user->email}}">{{$teacher->admin->user->email}}</a>@endif</td>
                              <td>@isset($teacher->organizerContactInformation->country) {{ __('countries.'.$teacher->organizerContactInformation->country)}} @endisset</td>
                              <td>{{$teacher->is_visible_name ??''}}</td>
                              <td>{{$teacher->status_name ??''}}</td>
                              <td class="d-none">
                                  <table class="table-in-row nowrap w-100">
                                      <tr>
                                          <td class="mx-4 text-muted text-small">Editors:</td>
                                          <td class="mx-4">{{$teacher->editorCount}}</td>
                                          <td class="mx-4 text-muted text-small">Members:</td>
                                          <td class="mx-4">{{$teacher->memberCount}}</td>
                                          <td class="mx-4 text-muted text-small">Others:</td>
                                          <td class="mx-4">...</td>
                                      </tr>
                                      @if($teacher->organizerContactInformation)
                                          <tr>
                                              <td class="mx-4 text-muted text-small">Address:</td>
                                              <td class="mx-4" colspan="5">{{$teacher->organizerContactInformation->city ??''}} {{$teacher->organizerContactInformation->zip ??''}}</td>

                                          </tr>
                                      @endif
                                  </table>
                              </td>
                              <td>{{$teacher->eventCount}}</td>
                              @if(auth()->user()->rule_id == 4)
                                  <td>{{$teacher->certificationCount}}</td>
                                  <td>{{sizeof($teacher->notifications)}} ({{$teacher->admin->user->language_code ??''}})</td>
                              @endif
                          </tr>
                      @endforeach
                      </tbody>
                  </table>
                </div>
        </div>
      </div>
    </div>

@endsection
