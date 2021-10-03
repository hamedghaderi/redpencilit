<x-layouts.auth banner="{{ asset('images/login.jpg') }}">
    <div class="w-full -mt-12">
        <x-logo/>
    </div>

    <form action="{{ route('login') }}" method="POST" class="w-full">
        @csrf

        <h1 class="text-3xl font-bold mb-8 text-gray-700">{{ __('login') }}</h1>

        <x-input name="email" type="email">
            <x-input-icon class="las la-envelope"/>
        </x-input>

        <x-input name="password" type="password">
            <x-input-icon class="las la-lock-open"/>
        </x-input>

        <div class="relative text-sm space-x-3 xl:flex justify-between items-center">
            <div class="mb-4 xl:mb-0">
                <a class="text-gray-500 hover:text-gray-700 hover:underline @if (app()->getLocale() === 'fa') ml-4 @else mr-4 @endif"
                   href="{{ route('register') }}">{{ __('register') }}</a>
                <a class="text-gray-500 hover:text-gray-700 hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forget password') }}{{ __('?') }}
                </a>
            </div>

            <x-button>
                {{__('login')}}
            </x-button>
        </div>
    </form>

    <div class="self-end w-full md:flex justify-between">
    </div>
</x-layouts.auth>
