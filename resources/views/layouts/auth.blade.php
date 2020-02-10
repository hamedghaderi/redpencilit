<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RedPencilIt') }}</title>

    <!-- Styles -->
    <link href=" {{ asset('css/line-awesome.min.css') }}" rel="stylesheet" >
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
        <header class="bg-white sm:flex sm:justify-between sm:items-center sm:px-4 sm:py-3">
            <div class="flex items-center justify-between px-4 py-3 sm:p-0">
                <div>
                    <a href="{{ route('home', app()->getLocale()) }}">
                        <img class="h-8 md:h-12" src="{{ asset('images/logo-last.svg') }}" alt="Redpencilit">
                    </a>
                </div>

                <div class="sm:hidden">
                    <button type="button" class="text-grey-dark focus:text-black focus:outline-none hover:text-black"
                            @click="isOpen = !isOpen">
                        <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                             width="24"
                             height="24">
                            <path v-if="isOpen"
                                    class="heroicon-ui" d="M16.24 14.83a1 1 0 0 1-1.41 1.41L12 13.41l-2.83 2.83a1 1 0
                            0 1-1.41-1.41L10.59 12 7.76 9.17a1 1 0 0 1 1.41-1.41L12 10.59l2.83-2.83a1 1 0 0 1 1.41 1.41L13.41 12l2.83 2.83z"/>
                            <path v-else
                                    class="heroicon-ui" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                        </svg>
                    </button>
                </div>
            </div>


            <div class="px-2 pt-2 pb-4 sm:p-0 sm:flex" :class="isOpen ? 'block' : 'hidden'">
                @if (app()->getLocale() === "en")
                    <a class="px-2 md:px-4 text-grey text-xs py-3 md:py-2 hover:bg-grey-dark
                    md:hover:bg-transparent
                        rounded hover:text-white md:hover:text-indigo"
                       href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale' => 'fa',
                       'token' => request('token')]) }}">
                        فارسی
                    </a>
                @else
                    <a class="px-2 md:px-4 text-grey text-xs py-3 md:py-2 hover:bg-grey-dark
                    md:hover:bg-transparent
                        rounded hover:text-white md:hover:text-indigo"
                       href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale' => 'en',
                       'token' => request('token')]) }}">
                        En
                    </a>
                @endif

                <a href="{{ route('posts.index', app()->getLocale()) }}" class="block text-grey-darker text-sm
                md:text-lg rounded
                py-1 mb-1 @if (app()->getLocale() === 'fa') sm:mr-2 @else sm:ml-2 @endif sm:mb-0 px-2
                hover:bg-grey-light">
                    {{ __('blog') }}
                </a>

                <a href="{{ route('about', app()->getLocale()) }}" class="block text-grey-darker text-sm md:text-lg
                rounded py-1
                mb-1
                sm:mb-0
                sm:mr-2 px-2
                hover:bg-grey-light">{{ __('about') }}</a>
                <a href="{{ route('contact', app()->getLocale()) }}" class="block text-grey-darker text-sm md:text-lg
                rounded
                py-1 px-2
                hover:bg-grey-light">
                    {{ __('contact') }}
                </a>

                @yield('nav-link')
            </div>
        </header>

        <main>
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>
