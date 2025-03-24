<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ env('APP_NAME') }}</title>
    <!-- Bootstrap CSS (If not already included) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons for Better UI -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Bootstrap 4 is included in app.css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?kaleshwarV2">
    <link rel="stylesheet" href="{{ asset('css/basic.css') }}?kaleshwarV2">
    <!-- Bootstrap CSS (If not already included) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons for Better UI -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Bootstrap JS (Required for modal to work) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/perfect-scrollbar.min.js') }}?kaleshwarV1"></script>
    <!-- jQuery is included in app.js -->
    <script src="{{ asset('js/app.js') }}?kaleshwarV2"></script>
    <script src="{{ asset('js/hopscotch.min.js') }}?kaleshwarV1"></script>
    <script src="{{ asset('js/basic.js') }}?kaleshwarV2"></script>
    <script src="{{ asset('js/help-tours.js') }}?kaleshwarV1"></script>
    <!-- Bootstrap JS (Required for modal to work) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/k5pmkr9w9ojqeug8pfm1jiu1znnxamwb3sx60k3k89d83v1n/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
<div class="app-admin-wrap layout-horizontal-bar clearfix">
    @guest
        <div class="main-content-wrap d-flex flex-column" id="print-area">
            @yield('content')
        </div>
    @else
        <div class="navbar-container">
            @include('partials.navbar')
        </div>

        @include('templates.modal')

        <div class="main-content-wrap d-flex flex-column" id="print-area">
            @yield('content')
        </div>

    @endguest

    @if (auth()->user()['rule_id'] >= 4)
        {{-- Mega menu --}}
        @include('partials.mega-menu')
    @endif

</div>
<div class="text-center mt-3">
    <span class="text-muted">Copyright Shirdi Sai Global Trust, Penukonda, India</span>
</div>
</body>

</html>
