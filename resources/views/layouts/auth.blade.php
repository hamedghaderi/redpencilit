<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RedPencilIt') }}</title>

    <!-- Styles -->
    <link href=" {{ asset('css/line-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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
         !!}
    </script>
</head>
<body>
<div id="app">
    @if (session()->has('message'))
        <x-flash type="{{ session('flash_type') }}" message="{{ session('message') }}"/>
    @endif

    {{ $slot ?? '' }}
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('script')
</body>
</html>
