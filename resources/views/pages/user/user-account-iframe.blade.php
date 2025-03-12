@extends('templates.default')

@section('content')
    <div class="container">
        <iframe src="/{{app()->getLocale()}}/iframe/user-account-basic" width="100%" height="900px" scrolling="auto" frameborder="0"></iframe>
    </div>
@endsection
