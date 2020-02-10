<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RedPencilIt') }}</title>



    <!-- Styles -->
    <link href=" {{ asset('css/vendor/all.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-primary" style="min-height: 100vh;">
    <div id="app">
        <nav class="rtl h-16 pt-24 mb-24">
            <div class="flex justify-center">
                <h1 class="flex content-center items-center font-normal text-2xl px-6 font-sans h-16">
                    <a class="text-white no-underline" href="{{ '/'.app()->getLocale() }}">RedPencilIt</a>
                </h1>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>
