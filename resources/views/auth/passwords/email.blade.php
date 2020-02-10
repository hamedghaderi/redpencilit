@extends('layouts.auth')

@section('content')
    <flash message="{{ session('status') }}"></flash>

    <div class="container">
        <div class="mt-24 w-full sm:w-3/4 md:w-2/3 lg:w-2/5 mx-auto">
            <div class="card">
                <h2 class="text-center text-grey-darkest mb-4">{{ __('Forgot your password?') }}</h2>

                <p class="text-sm text-center leading-loose text-grey mb-6">
                    {{__("Don't worry! Enter your email at the below section to help you take it back")}}
                </p>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.email', app()->getLocale()) }}" novalidate>
                        @csrf

                        <div class="form-group mb-6">
                            <div class="flex relative">
                                <input id="email" type="email"
                                       class="input w-full field-rtl pl-12 rounded block{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email" value="{{ old('email') }}" required placeholder="{{ __('email')
                                       }}">

                                <span class="input-icon">
                                    <i class="la la-envelope text-2xl"></i>
                                </span>
                            </div>

                            @if ($errors->has('email'))
                                <div class="feedback feedback--invalid my-2" role="alert">
                                    <p>{{ $errors->first('email') }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="flex items-center">
                                <button type="submit" class="button button--primary py-2 px-3">
                                    {{ __('Send password reset to my email')  }}
                                </button>

                                <a href="{{ route('login', app()->getLocale()) }}" class="button button--neutral
                                shadow-none hover:shadow-none py-2 px-3
                                 {{ app()->getLocale() === 'fa' ? 'mr-auto' : 'ml-auto' }}">
                                    {{ __('cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
