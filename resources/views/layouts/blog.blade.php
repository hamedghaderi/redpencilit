<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta id="csrf" name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RedPencilIt') }}</title>


    <!-- Styles -->
    <link href=" {{ asset('css/vendor/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>
        window.Redpencilit = {!!
            json_encode([
                'signed' => Auth::check(),
                'user' => Auth::user()
            ]);
         !!}
    </script>
</head>
<body class="blog-posts bg-white">
<div id="app">
    @include('partials/nav')

    <main class="-mt-24">
        @yield('content')
    </main>

    <flash message="{{ session('flash') }}"></flash>
</div>

<script src="/js/app.js"></script>
@yield('script')
</body>
</html>
