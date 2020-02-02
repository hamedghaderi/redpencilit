<footer class="footer pt-0 md:pt-32 bg-white md:bg-transparent">
    <div class="flex items-center flex-wrap container mb-12 pt-0 md:pt-8">
        <div class="w-full md:w-1/3 mb-12 mt-12 md:mt-0">
            <a href="{{ route('home', app()->getLocale()) }}">
                <img class="w-12 md:w-24" src="{{ asset('images/logo-last.svg') }}" alt="Redpecilit">
            </a>

            <ul class="list-reset flex text-sm">
                <li class="@if (app()->getLocale() === 'fa') ml-6 @else mr-6 @endif">
                    <a class="text-grey" href="{{ route('about', app()->getLocale()) }}">
                        {{ ucfirst(__('about')) }}
                    </a>
                </li>

                <li class="@if (app()->getLocale() === 'fa') ml-6 @else mr-6 @endif">
                    <a class="text-grey" href="{{ route('contact', app()->getLocale()) }}">
                        {{ ucfirst(__('contact us')) }}
                    </a>
                </li>

                <li class="@if (app()->getLocale() === 'fa') ml-6 @else mr-6 @endif">
                    <a class="text-grey" href="{{ route('pages.services', app()->getLocale()) }}">
                        {{ ucfirst(__('services')) }}
                    </a>
                </li>

                <li class="@if (app()->getLocale() === 'fa') ml-6 @else mr-6 @endif">
                    <a class="text-grey" href="{{ route('new-order', app()->getLocale()) }}">
                        {{ ucfirst(__('new order')) }}
                    </a>
                </li>
            </ul>
        </div>

        <div class="md-w1/3 mb-12 md:mb-0">
            <h3 class="text-grey-darker mb-2 text-normal">{{ ucfirst(__('communications')) }}</h3>

            <ul class="list-reset text-grey">
                <li class="mb-2 text-sm">{{ __('phone number') }}: 00345345345</li>
                <li class="mb-2 text-sm">{{ __('mobile number') }}: 903249039402340</li>
                <li class="mb-2 text-sm">{{ __('email address') }}: jjsldfj@jlasdkfj.com</li>
            </ul>
        </div>

        <div class="w-full md:w-1/3 @if (app()->getLocale() === 'fa') mr-auto @else ml-auto @endif">
            {{--   Search Box     --}}
            <form action="{{ route('posts.index', app()->getLocale()) }}" method="GET" class="mb-3">
                <div class="relative">
                    <input type="text"
                           class="input rounded-full focus:shadow-none"
                           placeholder="{{ __('blog search') }}">

                    <button type="submit" class="w-10 h-10 bg-grey text-white rounded-full absolute
                    pin-t hover:shadow-lg @if (app()->getLocale() === 'fa') ml-1 pin-l @else mr-1 pin-r @endif"
                            style="margin-top: .2rem">
                        <i class="las la-search text-2xl"></i>
                    </button>
                </div>
            </form>

            <div class="text-center md:text-left text-lg">
                <a href="#" class="text-grey"><i class="fab fa-facebook-square"></i></a>
                <a href="#" class="text-grey mr-2"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-grey mr-2"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>

    <p class="text-center text-grey-light text-xs pb-4 md:pb-0">{{ __('All rights reserved. Copyright@2019 by
    Redpenciliit.') }}</p>
</footer>
