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
        <p class="text-gray-500 text-sm mb-4 md:mb-0">{{ __('login_with') }}</p>

        <ul class="flex text-sm">
            <li>
                <div id="g_id_onload"
                     data-client_id="406128393293-bo1fvqpl9j9g2rb122g145s3gvgpkrd9.apps.googleusercontent.com"
                     data-context="signin"
                     data-ux_mode="popup"
                     data-login_uri="https://127.0.0.1:8000"
                     data-auto_prompt="false">
                </div>

                <div class="g_id_signin"
                     data-type="standard"
                     data-shape="rectangular"
                     data-theme="outline"
                     data-text="signin_with"
                     data-size="large"
                     data-logo_alignment="left">
                </div>
            </li>
            <li><a class="text-blue-500 hover:text-blue-700 mx-2" href="/login/google">{{ __('google') }}</a></li>
            <li><a class="text-blue-500 hover:text-blue-700 mx-2" href="#">{{ __('twitter') }}</a></li>
            <li><a class="text-blue-500 hover:text-blue-700 mx-2" href="#">{{ __('instagram') }}</a></li>
        </ul>
    </div>


    <script src="https://accounts.google.com/gsi/client" async defer></script>
</x-layouts.auth>
