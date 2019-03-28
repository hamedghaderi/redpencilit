<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta id="csrf" name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RedPencilIt') }}</title>


    <!-- Styles -->
    <link href=" {{ asset('css/vendor/all.css') }}" rel="stylesheet" >
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
<body>
<div id="app">
    @include('partials.right-nav')

    <main class="pt-6" style="padding-right: 250px;">
        <div class="container">
            @yield('content')
        </div>
    </main>
</div>

<script src="/js/app.js"></script>
@yield('script')
</body>
</html>
