<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta id="csrf" name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RedPencilIt') }}</title>


    <!-- Styles -->
    <link href="{{ asset('css/line-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('header')

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

        window.default_locale = "{{ config('app.locale') }}";
        window.fallback_locale = "{{ config('app.fallback_locale') }}";
        window.messages = @json($messages);
    </script>
</head>
<body>
<div id="app">
    @include('partials.right-nav')

    <main class="pt-6 @if (app()->getLocale() === 'fa') md:pr-64 @else md:pl-64 @endif">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <flash message="{{ session('flash') }}"></flash>
</div>

<script src="/js/app.js"></script>
@yield('script')
</body>
</html>
