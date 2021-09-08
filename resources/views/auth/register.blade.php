<x-layouts.auth banner="{{asset('images/register.jpg')}}">
    <div class="w-full -mt-12">
        <x-logo/>
    </div>

    <form action="{{ route('register') }}" method="POST" class="w-full">
        <h1 class="text-3xl font-bold mb-8 text-gray-700">{{ __('create_account') }}</h1>

        @csrf

        <x-input name="name">
            <x-input-icon class="las la-user"/>
        </x-input>

        <x-input name="email">
            <x-input-icon class="las la-envelope"/>
        </x-input>

        <x-input name="phone_number">
            <x-input-icon class="las la-mobile-alt"/>
        </x-input>

        <div class="relative mb-8" x-data="{ type: 'password' }">
            <input x-bind:type="type" name="password"
                   class="rounded-lg border px-4 py-2 w-full block focus:outline-none focus:ring-4 focus:ring-gray-500 focus:ring-opacity-20 focus:border-gray-500 @if (app()->getLocale() === 'fa') pr-10 @else pl-10 @endif"
                   placeholder="{{ __('password') }}"
                   autocomplete="password">

            <i class="absolute top-1.5 text-xl las la-lock-open z-10 text-gray-600 @if (app()->getLocale() === 'fa') right-0 mr-4 @else left-0 ml-4 @endif"></i>

            <span x-on:click="type = (type === 'password') ? 'text': 'password'">
                <i x-show="type === 'password'"
                   class="absolute top-1.5 text-2xl cursor-pointer las la-eye z-10 text-gray-400 @if (app()->getLocale() === 'fa') left-0 ml-4 @else right-0 mr-4 @endif"></i>
                <i x-show="type === 'text'"
                   class="absolute top-1.5 text-2xl cursor-pointer las la-eye-slash z-10 text-gray-400 @if (app()->getLocale() === 'fa') left-0 ml-4 @else right-0 mr-4 @endif"></i>
           </span>

            @error('password')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-8 text-sm">
            <p>
                {{ __('register_first_term') }} <a href="#"
                                                   class="text-blue-500 hover:underline">{{ __('register_terms_link') }}</a> {{ __('and') }}
                <a
                        href="#" class="text-blue-500 hover:underline">{{ __('register_policy') }}</a>
            </p>
        </div>

        <div class="relative text-sm space-x-3 flex justify-between items-center mb-8">
            <x-button>{{ __('register') }}</x-button>
        </div>

        <div class="mb-8 text-sm">
            <p>
                {{ __('already_have_account') }} <a href="{{ route('login') }}"
                                                    class="text-blue-500 font-bold hover:underline">{{ __('login') }}</a>
            </p>
        </div>
    </form>
</x-layouts.auth>
