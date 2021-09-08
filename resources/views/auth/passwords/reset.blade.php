<x-layouts.auth banner="{{ asset('images/reset.jpg') }}">
    <div class="w-full -mt-12">
        <x-logo/>
    </div>


    <form method="POST" action="{{ route('password.update', app()->getLocale()) }}" class="w-full">
        @csrf

        <h1 class="text-3xl font-bold mb-8 text-gray-700">{{ __('reset_password') }}</h1>

        <input type="hidden" name="token" value="{{ $token }}">

        <x-input type="email" name="email" readonly value="{{$email}}">
            <x-input-icon class="las la-envelope"/>
        </x-input>

        <x-input type="password" name="password" placeholder="{{ __('new_password') }}">
            <x-input-icon class="la la-key"/>
        </x-input>

        <x-input type="password" name="password_confirmation">
            <x-input-icon class="la la-check-double"/>
        </x-input>

        <div class="form-group row mb-0">
            <x-button>{{ __('reset_password') }}</x-button>
        </div>
    </form>
</x-layouts.auth>
