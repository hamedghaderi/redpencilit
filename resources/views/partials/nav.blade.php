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
                <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     width="24"
                     height="24">
                    <path v-if="isOpen"
                          class="heroicon-ui" d="M16.24 14.83a1 1 0 0 1-1.41 1.41L12 13.41l-2.83 2.83a1 1 0
                            0 1-1.41-1.41L10.59 12 7.76 9.17a1 1 0 0 1 1.41-1.41L12 10.59l2.83-2.83a1 1 0 0 1 1.41 1.41L13.41 12l2.83 2.83z"/>
                    <path v-else
                          class="heroicon-ui"
                          d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                </svg>
            </button>
        </div>

        <div class="hidden md:block flex-grow">
            <ul class="list-reset px-2 mb-2 flex justify-center w-full">
                <li><a class="px-2 md:px-4 text-grey-dark text-sm py-3 md:py-2 hover:bg-grey-dark md:hover:bg-transparent
                rounded
                hover:text-white md:hover:text-indigo"
                       href="{{ route('home', app()->getLocale()) }}">خانه</a></li>
                <li><a class="px-2 md:px-4 text-grey-dark text-sm py-3 md:py-2 hover:bg-grey-dark md:hover:bg-transparent
                rounded
                hover:text-white md:hover:text-indigo"
                       href="{{ route('about', app()->getLocale()) }}">درباره</a></li>
                <li><a class="px-2 md:px-4 text-grey-dark text-sm py-3 md:py-2 hover:bg-grey-dark md:hover:bg-transparent
                rounded
                hover:text-white md:hover:text-indigo"
                       href="{{ route('contact', app()->getLocale()) }}">تماس با
                        ما</a></li>
                <li><a class="px-2 md:px-4 text-grey-dark text-sm py-3 md:py-2 hover:bg-grey-dark md:hover:bg-transparent
                rounded
                hover:text-white md:hover:text-indigo"
                       href="{{ route('pages.services', app()->getLocale()) }}">خدمات</a></li>
                <li><a class="px-2 md:px-4 text-grey-dark text-sm py-3 md:py-2 hover:bg-grey-dark md:hover:bg-transparent
                rounded
                hover:text-white md:hover:text-indigo"
                       href="{{ route('new-order', app()->getLocale()) }}">سفارش
                        جدید</a></li>
            </ul>
        </div>

        <div class="hidden md:inline-block flex-grow-0">
            <nav-dropdown locale="{{ app()->getLocale() }}"></nav-dropdown>
        </div>
    </div>



    <div v-if="isOpen" class="md:hidden">
        <ul class="list-reset px-2 mb-2">
            <li><a class="px-2 text-grey-dark text-sm block py-3 hover:bg-grey-dark rounded hover:text-white mb-1"
                   href="/">خانه</a></li>
            <li><a class="px-2 text-grey-dark text-sm block py-3 hover:bg-grey-dark rounded hover:text-white mb-1"
                   href="/about">درباره</a></li>
            <li><a class="px-2 text-grey-dark text-sm block py-3 hover:bg-grey-dark rounded hover:text-white mb-1"
                   href="/contact">تماس با
                    ما</a></li>
            <li><a class="px-2 text-grey-dark text-sm block py-3 hover:bg-grey-dark rounded hover:text-white mb-1"
                   href="/services">خدمات</a></li>
            <li><a class="px-2 text-grey-dark text-sm block py-3 hover:bg-grey-dark rounded hover:text-white"
                   href="/orders/create">سفارش
                    جدید</a></li>
        </ul>

        <div class="block md:hidden border-t border-t-1">
            <ul class="list-reset py-2 px-2">
                @if (auth()->guest())
                    <li><a class="text-grey-dark py-3 px-2 block text-sm hover:bg-blue-lightest hover:text-blue-dark
                    rounded mb-1"
                           href="/login">ورود</a></li>
                    <li><a class="text-grey-dark py-3 px-2 block text-sm hover:bg-green-lightest hover:text-green-dark
                    rounded"
                           href="/register">عضویت</a></li>
                @else
                    <li>
                        <a class="rounded text-grey-dark text-sm block hover:bg-red-lightest hover:text-red-dark px-2
                        py-3"
                           href="#"
                           onclick="document.getElementById('logout').submit()
">خروج از
                            حساب</a>

                        <form id="logout" action="/logout" method="POST">
                            @csrf
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</header>
