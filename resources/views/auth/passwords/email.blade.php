<x-layouts.auth banner="{{ asset('images/forget-password.jpg') }}">

    <div class="w-full">
        <x-logo/>
    </div>

    <form class="w-full" method="POST" action="{{ route('password.email', app()->getLocale()) }}" novalidate>
        @csrf

        <h2 class="text-3xl font-bold mb-2 text-gray-700">{{ __('forget_password') }}</h2>

        <p class="mb-8 text-sm text-gray-700">{{ __('forget_password_instruction') }}</p>

        <x-input name="email">
            <x-input-icon class="las la-user"/>
        </x-input>

        <div class="flex items-center w-full">
            <x-button>
                {{ __('Send password reset to my email')  }}
            </x-button>

            <a href="{{ route('login', app()->getLocale()) }}"
               class="underline text-gray-500 text-sm">
                {{ ucfirst( __('cancel') )}}
            </a>
        </div>
    </form>

</x-layouts.auth>
