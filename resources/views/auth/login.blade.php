@extends('layouts.auth')

@section('nav-link')
    <a href="{{ route('register', app()->getLocale()) }}" class="block text-grey-darker text-sm rounded py-1 mb-1 sm:mb-0
                sm:mr-2 px-2
                hover:bg-grey-light sm:hidden">
        {{ __('register') }}
    </a>

    <a href="{{ route('register', app()->getLocale()) }}" class="hidden
                button
                button--success
                sm:block
                py-1
                mb-1
                sm:mb-0
                text-lg
                @if (app()->getLocale() === 'fa') sm:mr-2 @else sm:ml-2 @endif
                px-4">
        {{ __('register') }}
    </a>
@endsection

@section('content')
    <div class="container">
        <div class="w-full sm:w-3/4 md:w-2/3 lg:w-2/5 mx-auto">

            <div class="mt-24 card">
                <h2 class="text-lg md:text-2xl font-bold text-grey-darker mb-4 text-center font-normal">
                    {{ __('login') }}
                </h2>

                <p class="text-grey text-center mb-8">{{ __('welcome') }}</p>
                <form method="POST" action="{{ route('login', app()->getLocale()) }}" class="text-md w-full" novalidate>
                    @csrf

                    <div class="mb-4">
                        <div>
                            <div class="flex relative">
                                <input id="email" type="email" class="input rounded block{{
                            $errors->has('email') ? ' is-invalid' : '' }}
                                        @if (app()->getLocale() === 'fa') pl-12 field-rtl @else pr-12 @endif"
                                       name="email"
                                       value="{{ old
                                        ('email') }}"
                                       required autofocus placeholder="{{ __('email address') }}">

                                <span class="absolute text-grey-dark flex items-center h-full
                                    @if (app()->getLocale() === 'fa') pin-l ml-6 @else pin-r mr-6 @endif">
                                    <i class="la la-envelope text-2xl"></i>
                                </span>
                            </div>

                            @if ($errors->has('email'))
                                <div class="feedback feedback--invalid my-2">
                                    <p>
                                        {{ $errors->first('email') }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="mb-4">
                        <div>
                            <div class="flex relative">
                                <input id="password" type="password" class="input rounded block{{
                            $errors->has('password') ? ' is-invalid' : '' }}
                                @if (app()->getLocale() === 'fa') pl-12 field-rtl @else pr-12 @endif" name="password" required
                                       placeholder="{{ __('password') }}">

                                <span class="absolute text-grey-dark flex items-center h-full
                                    @if (app()->getLocale() === 'fa') pin-l ml-6 @else pin-r mr-6 @endif">
                                    <i class="la la-key text-2xl"></i>
                                </span>
                            </div>

                            @if ($errors->has('password'))
                                <div class="feedback feedback--invalid my-2">
                                    <p>
                                        {{ $errors->first('password') }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="w-full p-2 flex items-center">
                            <label class="mb-0 flex">
                                <input
                                       type="checkbox"
                                       name="remember"
                                       id="remember" {{ old
                            ('remember') ? 'checked' : '' }}>
                                <span class="check-toggle ml-2"></span>

                                <label class="text-grey-darker text-sm" for="remember">
                                    {{ __('Remember my choice') }}
                                </label>
                            </label>

                            @if (Route::has('password.request'))
                                <p class="@if (app()->getLocale() === 'fa')mr-auto text-left @else ml-auto text-right
                                 @endif">
                                    <a href="{{ route('password.request', app()->getLocale()) }}"
                                       class="text-blue text-xs no-underline hover:text-blue-dark">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 text-center offset-md-4">
                            <button type="submit" class="button button--primary">
                                {{ __("Log me in") }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </divcl>

@endsection

@section('script')
    @include('partials.rtl-input')
    @include('partials.form')
@endsection
