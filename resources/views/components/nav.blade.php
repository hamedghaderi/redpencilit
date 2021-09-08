<header class="z-50 bg-transparent md:items-center mb-8 py-0">
    <div class="flex items-center lg:py-3 sm:p-0 lg:w-full">
        {{--   Logo     --}}
        <x-logo/>

        {{-- Mobile Responsive Menu --}}
        <div class="lg:hidden @if(app()->getLocale() === 'fa') mr-auto @else ml-auto @endif">
            <x-dropdown>
                <x-slot name="trigger">
                    <button type="button"
                            class="cursor-pointer text-gray-dark focus:text-black focus:outline-none hover:text-black">
                        <i class="la la-bars text-2xl"></i>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <ul class="w-75 text-gray-700 py-4 capitalize">
                        <li>
                            <a class="block hover:bg-gray-100 py-2 px-4" href="{{ route('home') }}">{{ __('home') }}</a>
                        </li>

                        <li>
                            <a class="block hover:bg-gray-100 py-2 px-4"
                               href="{{ route('about') }}">{{ __('about') }}</a>
                        </li>
                        <li>
                            <a class="block hover:bg-gray-100 py-2 px-4"
                               href="{{ route('contact') }}">{{ __('contact') }}</a>
                        </li>
                        <li>
                            <a class="block hover:bg-gray-100 py-2 px-4"
                               href="{{ route('pages.services') }}">{{ __('services') }}</a>
                        </li>
                        <li>
                            <a class="block hover:bg-gray-100 py-2 px-4"
                               href="{{ route('posts.index') }}">{{ __('blog') }}</a>
                        </li>
                        <li>
                            <a class="block hover:bg-gray-100 py-2 px-4"
                               href="{{ route('new-order') }}">{{ __('new-order') }}</a>
                        </li>

                        {{--  Divider    --}}
                        <li class="border-b border-gray-200 my-2 -mx-4"></li>


                        @guest()
                            <li>
                                <a class="block hover:bg-gray-100 py-2 px-4"
                                   href="{{ route('login') }}">{{ __('login') }}</a>
                            </li>
                            <li>
                                <a class="block hover:bg-gray-100 py-2 px-4"
                                   href="{{ route('register') }}">{{ __('register') }}</a>
                            </li>
                        @endguest

                        @auth()
                            <li>
                                <a class="block hover:bg-gray-100 py-2 px-4"
                                   href="{{ route('dashboard') }}">{{ __('profile') }}</a>
                            </li>
                        @endauth
                    </ul>
                </x-slot>
            </x-dropdown>
        </div>


        {{--   Main Menu    --}}
        <div class="hidden lg:flex justify-between flex-1 items-center">
            <ul class="list-reset px-2 mb-2 flex justify-center w-full text-lg">
                <li>
                    <a class="px-2 md:px-4 py-3 md:py-2 rounded text-gray-500 hover:text-gray-700 transition capitalize @if(app()->getLocale() === 'en') text-base @endif"
                       href="{{ route('home', app()->getLocale()) }}">
                        {{ __('home') }} </a>
                </li>

                <li>
                    <a class="px-2 md:px-4 py-3 md:py-2 rounded text-gray-500 hover:text-gray-700 transition capitalize @if(app()->getLocale() === 'en') text-base @endif"
                       href="{{ route('about', app()->getLocale()) }}">
                        {{ __('about') }}
                    </a>
                </li>

                <li>
                    <a class="px-2 md:px-4 py-3 md:py-2 rounded text-gray-500 hover:text-gray-700 transition capitalize @if(app()->getLocale() === 'en') text-base @endif"
                       href="{{ route('contact', app()->getLocale()) }}">
                        {{ __('contact') }}
                    </a>
                </li>

                <li>
                    <a class="px-2 md:px-4 py-3 md:py-2 rounded text-gray-500 hover:text-gray-700 transition capitalize @if(app()->getLocale() === 'en') text-base @endif"
                       href="{{ route('pages.services', app()->getLocale()) }}">
                        {{ __('services') }}
                    </a>
                </li>

                <li>
                    <a class="px-2 md:px-4 py-3 md:py-2 rounded text-gray-500 hover:text-gray-700 transition capitalize @if(app()->getLocale() === 'en') text-base @endif"
                       href="{{ route('posts.index', app()->getLocale()) }}">
                        {{ __('blog') }}
                    </a>
                </li>

                <li>
                    <a class="px-2 md:px-4 py-3 md:py-2 rounded text-gray-500 hover:text-gray-700 transition capitalize @if(app()->getLocale() === 'en') text-base @endif"
                       href="{{ route('new-order', app()->getLocale()) }}">
                        {{ __('new order') }}
                    </a>
                </li>

                @if (app()->getLocale() === "en")
                    <li>
                        <a class="px-2 md:px-4 py-3 md:py-2 rounded text-gray-500 hover:text-gray-700 transition capitalize text-xs"
                           style="@if(app()->getLocale() === 'en') font-family: 'Sahel'; @endif"

                           href="{{ str_replace(url()->current(), '/en/', '/fa/') }}">
                            فارسی
                        </a>
                    </li>
                @else
                    <li>
                        <a class="px-2 md:px-4 py-3 md:py-2 rounded text-gray-500 hover:text-gray-700 transition capitalize text-xs"
                           href="{{ str_replace(url()->current(), '/fa/', '/en/') }}">
                            English
                        </a>
                    </li>
                @endif
            </ul>

            <x-dropdown class="ml-auto flex-shrink-0">
                <x-slot name="trigger">
                    @guest()
                        <button type="button"
                                class="bg-primary px-4 py-2 rounded-lg shadow text-white hover:bg-red-500 focus:ring-4 focus:ring-red-500 focus:ring-opacity-20">
                            {{ __('profile') }}
                        </button>
                    @endguest()

                    @auth()
                        <div type="button">
                            <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}">
                        </div>
                    @endauth()
                </x-slot>
                <x-slot name="content">
                    <ul class="py-2 space-y-4 text-gray-700">
                        @guest()

                            <li>
                                <a class="text-gray-700 inline-flex items-center hover:bg-gray-100 w-full rounded-lg p-2"
                                   href="{{ route('login')  }}">
                                    <i class="las la-sign-in-alt text-xl ml-2"></i>
                                    {{ __('login') }}
                                </a>
                            </li>
                            <li>
                                <a class="text-gray-700 inline-flex items-center hover:bg-gray-100 w-full rounded-lg p-2"
                                   href="{{ route('register')  }}">
                                    <i class="las la-user-plus text-xl ml-2"></i>
                                    {{ __('register') }}
                                </a>
                            </li>
                        @endguest

                        @auth()
                            <li>
                                <a class="text-gray-700 inline-flex items-center hover:bg-gray-100 w-full rounded-lg p-2"
                                   href="{{ route('dashboard')  }}">
                                    <i class="la la-dashboard text-xl ml-2"></i>
                                    {{ __('dashboard') }}
                                </a>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf

                                    <button type="submit"
                                            class="text-gray-700 inline-flex items-center hover:bg-gray-100 w-full rounded-lg p-2">
                                        <i class="la la-dashboard text-xl ml-2"></i>
                                        {{ __('logout') }}
                                    </button>
                                </form>
                            </li>
                        @endauth
                    </ul>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</header>
