<header class="z-50 bg-transparent md:items-center mb-8 py-0" v-cloak>
    <div class="flex items-center lg:py-3 sm:p-0 lg:w-full">
        {{--   Logo     --}}
        <div>
            <a href="{{ route('home', app()->getLocale()) }}">
                <img class="h-8 md:h-12" src="{{ asset('images/logo-last.svg') }}" alt="Redpencilit">
            </a>
        </div>

        <div class="lg:hidden @if (app()->getLocale() === 'fa') mr-auto @else ml-auto @endif">
            <button type="button" class="cursor-pointer text-grey-dark focus:text-black focus:outline-none
            hover:text-black"
                    @click="isOpen = !isOpen">
                <i class="la la-times text-2xl" v-if="isOpen"></i>
                <i class="la la-bars text-2xl" v-else></i>
            </button>
        </div>

        {{--   Main Menu     --}}
        <div class="hidden lg:flex">
            <ul class="list-reset px-2 mb-2 flex justify-center w-full text-lg">
                <li>
                    <a class="px-2 md:px-4 text-grey-dark py-3 md:py-2 hover:bg-grey-dark
                    md:hover:bg-transparent rounded hover:text-white md:hover:text-red"
                       href="{{ route('home', app()->getLocale()) }}">
                        {{ __('home') }}
                    </a>
                </li>

                <li>
                    <a class="px-2 md:px-4 text-grey-dark py-3 md:py-2 hover:bg-grey-dark md:hover:bg-transparent
                            rounded hover:text-white md:hover:text-red"
                       href="{{ route('about', app()->getLocale()) }}">
                        {{ __('about') }}
                    </a>
                </li>

                <li>
                    <a class="px-2 md:px-4 text-grey-dark py-3 md:py-2 hover:bg-grey-dark md:hover:bg-transparent
                            rounded hover:text-white md:hover:text-red"
                       href="{{ route('contact', app()->getLocale()) }}">
                        {{ __('contact') }}
                    </a>
                </li>

                <li>
                    <a class="px-2 md:px-4 text-grey-dark py-3 md:py-2 hover:bg-grey-dark
                        md:hover:bg-transparent rounded hover:text-white md:hover:text-red"
                       href="{{ route('pages.services', app()->getLocale()) }}">
                        {{ __('services') }}
                    </a>
                </li>

                <li>
                    <a class="px-2 md:px-4 text-grey-dark py-3 md:py-2 hover:bg-grey-dark
                        md:hover:bg-transparent rounded hover:text-white md:hover:text-red"
                       href="{{ route('posts.index', app()->getLocale()) }}">
                        {{ __('blog') }}
                    </a>
                </li>

                <li>
                    <a class="px-2 md:px-4 text-grey-dark py-3 md:py-2 hover:bg-grey-dark md:hover:bg-transparent
                            rounded hover:text-white md:hover:text-red"
                       href="{{ route('new-order', app()->getLocale()) }}">
                        {{ __('new order') }}
                    </a>
                </li>

                @if (app()->getLocale() === "en")
                    <li>
                        <a class="px-2 md:px-4 text-grey text-xs py-3 md:py-2 hover:bg-grey-dark
                        md:hover:bg-transparent
                            rounded hover:text-white md:hover:text-red"
                           href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), 'fa') }}">
                          فارسی
                        </a>
                    </li>
                @else
                    <li>
                        <a class="px-2 md:px-4 text-grey text-xs py-3 md:py-2 hover:bg-grey-dark
                        md:hover:bg-transparent
                            rounded hover:text-white md:hover:text-red"
                           href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), 'en') }}">
                            En
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="hidden lg:inline-block flex-grow-0 @if (app()->getLocale() === 'fa') mr-auto @else ml-auto @endif">
            <nav-dropdown home="true"></nav-dropdown>
        </div>
    </div>

    <div v-if="isOpen" class="lg:hidden relative mt-2">
        <div class="bg-white relative rounded-lg shadow border border-grey-lighter">
            <ul class="list-reset p-2 mb-2 relative z-10">
                <li>
                    <a class="px-2 text-grey-dark text-sm block py-3 hover:bg-indigo rounded hover:text-white mb-1"
                       href="{{ route('home', app()->getLocale()) }}">
                        {{ __('home') }}
                    </a>
                </li>
                <li>
                    <a class="px-2 text-grey-dark text-sm block py-3 hover:bg-indigo rounded hover:text-white mb-1"
                       href="{{ route('about', app()->getLocale()) }}">
                        {{ __('about') }}
                    </a>
                </li>
                <li>
                    <a class="px-2 text-grey-dark text-sm block py-3 hover:bg-indigo rounded hover:text-white mb-1"
                       href="{{ route('contact', app()->getLocale()) }}">
                        {{ __('contact') }}
                    </a>
                </li>
                <li>
                    <a class="px-2 text-grey-dark text-sm block py-3 hover:bg-indigo rounded hover:text-white mb-1"
                       href="{{ route('pages.services', app()->getLocale()) }}">
                        {{ __('services') }}
                    </a>
                </li>
                <li>
                    <a class="px-2 text-grey-dark text-sm block py-3 hover:bg-indigo rounded hover:text-white mb-1"
                       href="{{ route('posts.index', app()->getLocale()) }}">
                        {{ __('blog') }}
                    </a>
                </li>
                <li>
                    <a class="px-2 text-grey-dark text-sm block py-3 hover:bg-indigo rounded hover:text-white"
                       href="{{ route('new-order', app()->getLocale()) }}">
                        {{ __('new order') }}
                    </a>
                </li>
            </ul>

            <div class="block border-t border-grey-lighter">
                <ul class="list-reset py-2 px-2">
                    @guest
                        <li><a class="text-grey-dark py-3 px-2 block text-sm hover:bg-blue-lightest hover:text-blue-dark
                    rounded mb-1"
                               href="{{ route('login', app()->getLocale()) }}">
                                {{ __('account') }}
                            </a></li>
                        <li><a class="text-grey-dark py-3 px-2 block text-sm hover:bg-green-lightest hover:text-green-dark
                    rounded"
                               href="{{ route('register', app()->getLocale()) }}">{{ __('register') }}</a></li>
                    @endguest

                    @auth
                        <li>
                            <a href="{{ route('dashboard', [app()->getLocale(), auth()->user()]) }}" class="rounded
                                text-grey-dark text-sm block hover:bg-green-lightest hover:text-green-dark px-2 py-3">
                                {{ strtolower(__('dashboard')) }}
                            </a>
                        </li>
                        <li>
                            <a class="rounded text-grey-dark text-sm block hover:bg-red-lightest hover:text-red-dark px-2
                        py-3"
                               href="#"
                               onclick="document.getElementById('logout').submit()">
                                {{ strtolower(__('logout')) }}
                            </a>

                            <form id="logout" action="{{ route('logout', app()->getLocale()) }}" method="POST">
                                @csrf
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</header>
