<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-signin-client_id" content="{{ config('services.google.client_id') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RedPencilIt') }}</title>

    <link rel="stylesheet" href="{{ asset('css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        @if (app()->getLocale() === 'fa')
        body {
            text-align: right;
            direction: rtl;
            font-family: Sahel;
        }

        @else
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            direction: ltr;
            text-align: left;
        }
        @endif
    </style>


    <script>
        window.Redpencilit = {!!
            json_encode([
                'signed' => Auth::check(),
                'user' => Auth::user(),
                'locale' => app()->getLocale()
            ]);
         !!};
        window.default_locale = "{{ config('app.locale') }}";
        window.fallback_locale = "{{ config('app.fallback_locale') }}";
        window.messages = @json($messages);
    </script>
</head>
<body class="@if (app()->getLocale() === 'fa') fa @else en @endif">

@if (session()->has('message'))
    <x-flash type="{{ session('flash_type') }}" message="{{ session('message') }}"/>
@endif

<div id="app" class="overflow-hidden">
    {{ $slot }}
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

