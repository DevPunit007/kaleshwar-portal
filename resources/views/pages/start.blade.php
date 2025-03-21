@extends('templates.default')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4>{{__('start.header')}}</h4>
            <br/>
            @if (auth()->user()->rule_id == 3)
                {!! __('start.bodytext') !!}
            @else
                {!! __('start.bodytext') !!}
            @endif
        </div>
    </div>
</div>
<pre>
    @php //print_r($events); @endphp
</pre>
@endsection
