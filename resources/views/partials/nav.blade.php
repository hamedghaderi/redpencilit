<header class="bg-white md:bg-transparent border-b md:border-none border-grey-light sm:py-4 md:items-center mb-8 px-4
py-1">
    <div class="flex items-center justify-between px-4 py-3 sm:p-0 md:w-full">
        <div>
            <a href="{{ route('home', app()->getLocale()) }}">
                <img class="h-8 md:h-12" src="{{ asset('images/logo.svg') }}" alt="Redpencilit">
            </a>
        </div>

        <div class="md:hidden">
            <img src="" alt="">
            <button type="button" class="cursor-pointer text-grey-dark focus:text-black focus:outline-none
            hover:text-black"
                    @click="isOpen = !isOpen">
                <i class="la la-times text-2xl" v-if="isOpen"></i>
                <i class="la la-bars text-2xl" v-else></i>
            </button>
        </div>

        <div class="hidden md:block flex-grow">
            <ul class="list-reset px-2 mb-2 flex justify-center w-full">
                <li><a class="px-2 md:px-4 text-grey-dark text-sm py-3 md:py-2 hover:bg-grey-dark md:hover:bg-transparent
                rounded
                hover:text-white md:hover:text-indigo"
                       href="{{ route('home', app()->getLocale()) }}">{{ __('home') }}</a></li>
                <li><a class="px-2 md:px-4 text-grey-dark text-sm py-3 md:py-2 hover:bg-grey-dark md:hover:bg-transparent
                rounded
                hover:text-white md:hover:text-indigo"
                       href="{{ route('about', app()->getLocale()) }}">{{ __('about') }}</a></li>
                <li><a class="px-2 md:px-4 text-grey-dark text-sm py-3 md:py-2 hover:bg-grey-dark md:hover:bg-transparent
                rounded
                hover:text-white md:hover:text-indigo"
                       href="{{ route('contact', app()->getLocale()) }}">
                        {{ strtolower(__('contact')) }}
                    </a></li>
                <li><a class="px-2 md:px-4 text-grey-dark text-sm py-3 md:py-2 hover:bg-grey-dark md:hover:bg-transparent
                rounded
                hover:text-white md:hover:text-indigo"
                       href="{{ route('pages.services', app()->getLocale()) }}">{{ __('services') }}</a></li>
                <li><a class="px-2 md:px-4 text-grey-dark text-sm py-3 md:py-2 hover:bg-grey-dark md:hover:bg-transparent
                rounded
                hover:text-white md:hover:text-indigo"
                       href="{{ route('posts.index', app()->getLocale()) }}">{{ __('blog') }}</a></li>
                <li><a class="px-2 md:px-4 text-grey-dark text-sm py-3 md:py-2 hover:bg-grey-dark md:hover:bg-transparent
                rounded
                hover:text-white md:hover:text-indigo"
                       href="{{ route('new-order', app()->getLocale()) }}">{{ __('new order') }}</a></li>
            </ul>
        </div>

        <div class="hidden md:inline-block flex-grow-0">
            <nav-dropdown locale="{{ app()->getLocale() }}"></nav-dropdown>
        </div>
    </div>



    <div v-if="isOpen" class="md:hidden">
        <ul class="list-reset px-2 mb-2">
            <li><a class="px-2 text-grey-dark text-sm block py-3 hover:bg-grey-dark rounded hover:text-white mb-1"
                   href="{{ route('home', app()->getLocale()) }}">{{ __('home') }}</a></li>
            <li><a class="px-2 text-grey-dark text-sm block py-3 hover:bg-grey-dark rounded hover:text-white mb-1"
                   href="{{ route('about', app()->getLocale()) }}">{{ __('about') }}</a></li>
            <li><a class="px-2 text-grey-dark text-sm block py-3 hover:bg-grey-dark rounded hover:text-white mb-1"
                   href="{{ route('contact', app()->getLocale()) }}">{{ strtolower(__('contact')) }}</a></li>
            <li><a class="px-2 text-grey-dark text-sm block py-3 hover:bg-grey-dark rounded hover:text-white mb-1"
                   href="{{ route('pages.services', app()->getLocale()) }}">{{ __('services') }}</a></li>
            <li><a class="px-2 text-grey-dark text-sm block py-3 hover:bg-grey-dark rounded hover:text-white mb-1"
                   href="{{ route('posts.index', app()->getLocale()) }}">{{ __('blog') }}</a></li>
            <li><a class="px-2 text-grey-dark text-sm block py-3 hover:bg-grey-dark rounded hover:text-white"
                   href="{{ route('new-order', app()->getLocale()) }}">{{ __('new order') }}</a></li>
        </ul>

        <div class="block md:hidden border-t border-t-1">
            <ul class="list-reset py-2 px-2">
                @if (auth()->guest())
                    <li><a class="text-grey-dark py-3 px-2 block text-sm hover:bg-blue-lightest hover:text-blue-dark
                    rounded mb-1"
                           href="{{ route('login', app()->getLocale()) }}">{{ mb_strtolower(__('login')) }}</a></li>
                    <li><a class="text-grey-dark py-3 px-2 block text-sm hover:bg-green-lightest hover:text-green-dark
                    rounded"
                           href="{{ route('register', app()->getLocale()) }}">
                            {{ mb_strtolower(__('register')) }}
                        </a></li>
                @else
                    <li>
                        <a class="rounded text-grey-dark text-sm block hover:bg-green-lightest hover:text-green-dark
                        px-2
                        py-3"
                           href="{{ route('dashboard', [app()->getLocale(), auth()->id()]) }}"
                           >
                            {{ mb_strtolower(__('dashboard')) }}
                        </a>
                    </li>
                    <li>
                        <a class="rounded text-grey-dark text-sm block hover:bg-red-lightest hover:text-red-dark px-2
                        py-3"
                           href="#"
                           onclick="document.getElementById('logout').submit()">
                            {{ mb_strtolower(__('logout')) }}
                        </a>
                        <form id="logout" action="{{ route('logout', app()->getLocale()) }}" method="POST">
                            @csrf
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</header>
