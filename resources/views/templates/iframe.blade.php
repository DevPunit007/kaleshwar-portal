<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow" />
    <title>{{ env('APP_NAME') }}</title>

    <!-- Bootstrap 4 is included in app.css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?kaleshwarV2">
    <link rel="stylesheet" href="{{ asset('css/basic.css') }}?kaleshwarV2">

    <script src="{{ asset('js/perfect-scrollbar.min.js') }}?kaleshwarV1"></script>
    <!-- jQuery is included in app.js -->
    <script src="{{ asset('js/app.js') }}?kaleshwarV2"></script>
    <script src="{{ asset('js/hopscotch.min.js') }}?kaleshwarV1"></script>
    <script src="{{ asset('js/basic.js') }}?kaleshwarV2"></script>
    <script src="{{ asset('js/help-tours.js') }}?kaleshwarV1"></script>
    <script src="{{ asset('js/iframeResizer.contentWindow.min.js') }}?kaleshwarV1"></script>
</head>
<body class="event-frame">
<div class="app-admin-wrap layout-horizontal-bar clearfix">
    @yield('content')
</div>
</body>
</html>
