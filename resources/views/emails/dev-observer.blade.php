@extends('emails.templates.default')

@section('content')

    <h2>Dev Observer</h2>

    <p>
        <pre>
            {{print_r($request)}}
        </pre>
    </p>

    <p>
        <pre>
            {{print_r($user)}}
        </pre>
    </p>

@endsection
