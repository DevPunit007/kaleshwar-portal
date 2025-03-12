@extends('templates.default')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4>Audit Report</h4>
            <br/>
            <table class="table showList">
                <tbody>
                <tr class="bg-light border-bottom font-weight-bolder">
                    <td width="24%">Databasefield</td><td width="38%">New value</td><td width="38%">Old value</td>
                </tr>
                @foreach($audits as $audit)
                    <tr class="bg-white p-0">
                        <td colspan="3"></td>
                    </tr>
                    <tr class="alert-secondary text-dark">
                        <td colspan="3">Record {{$audit->auditable_type ??''}} {{$audit->auditable_id ??''}} at <b>{{date_format(date_create($audit->created_at), 'd.m.Y H:i')}}</b> {{$audit->event ??''}} from {{$audit->user_id ??''}}</td>
                    </tr>
                    @foreach($audit->getModified() as $key => $values)

                        @if(isset($values['old']) || isset($values['new']))
                            <tr>
                                <td class="py-2 bg-light">{{$key}}</td>
                                <td class="py-2 alert-success">@if(isset($values['new'])) {{$values['new']}} @endif</td>
                                <td class="py-2 alert-warning">@if(isset($values['old'])) {{$values['old']}} @endif</td>
                            </tr>
                        @endif

                    @endforeach

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<pre>
    @php //print_r($audits); @endphp
</pre>
@endsection
