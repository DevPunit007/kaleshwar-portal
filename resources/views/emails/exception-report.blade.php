@extends('emails.templates.default')

@section('head-content')
    <title>Kaleshwar Portal Error Report</title>
@endsection

@section('content')
    <div><pre>{{$exception}}</pre></div>
@endsection
