<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RedPencilIt') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href=" {{ asset('css/vendor/all.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-blue-darkest">
    <div id="app">
        <nav class="bg-white border-b border-grey-light rtl h-16">
            <div class="flex">
                <h1 class="flex content-center items-center border-l border-grey-light font-normal text-2xl px-6 font-sans h-16">
                    <a class="text-black no-underline" href="{{ url('/') }}">RedPencilIt</a>
                </h1>

                <!-- Right Side Of Navbar -->
                <ul class="px-6 mr-auto flex items-center list-reset text-sm border-r border-grey-light h-16">
                    <!-- Authentication Links -->
                    @guest
                        <li class="ml-8">
                            <a class="no-underline text-grey-dark has-icon hover:text-grey-darker" href="{{ route('login') }}">
                                <i class="fas fa-sign-out-alt text-grey-light"></i>
                                ورود به حساب کاربری
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="no-underline text-grey-dark has-icon hover:text-grey-darker" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus text-grey-light"></i>
                                    ثبت‌نام
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ route('dashboard',
                            Auth::user()->name) }}"
                               role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>

    @yield('script') 
</body>
</html>
