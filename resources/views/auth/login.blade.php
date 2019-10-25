@extends('layouts.auth')

@section('nav-link')
    <a href="{{ route('register') }}" class="block text-grey-darker text-sm rounded py-1 mb-1 sm:mb-0
                sm:mr-2 px-2
                hover:bg-grey-light sm:hidden">حساب
        جدیدی برام ایجاد کن</a>

    <a href="{{ route('register') }}" class="hidden
                button
                button--success
                sm:block
                py-1
                mb-1
                sm:mb-0
                sm:mr-2
                px-4">حساب
        جدیدی برام ایجاد کن</a>
@endsection

@section('content')
    <div class="container">
        <div class="w-full sm:w-3/4 md:w-2/3 lg:w-2/5 mx-auto">

            <div class="mt-24 card">
                <h2 class="text-lg md:text-2xl font-bold text-grey-darker mb-4 text-center font-normal">ورود به حساب
                    کاربری</h2>

                <p class="text-grey text-center mb-8">خوش آمدید</p>
                <form method="POST" action="/login" class="text-md w-full" novalidate>
                    @csrf

                    <div class="mb-4">
                        <div>
                            <div class="flex relative">
                                <input id="email" type="email" class="input field-rtl pl-12 rounded block{{
                            $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                       required autofocus placeholder="آدرس ایمیل">

                                <span class="absolute pin-l absolute-center ml-6 text-grey-dark">
                                    <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24
                                     24" width="24"
                                          height="24"><path class="heroicon-ui" d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"/></svg>
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
                                <input id="password" type="password" class="input field-rtl pl-12 rounded block{{
                            $errors->has('password') ? ' is-invalid' : '' }}" name="password" required
                                       placeholder="رمز عبور">

                                <span class="input-icon">
                                   <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24
                                   24" width="24"
                                         height="24"><path class="heroicon-ui" d="M11.85 17.56a1.5 1.5 0 0 1-1.06.44H10v.5c0 .83-.67 1.5-1.5 1.5H8v.5c0 .83-.67 1.5-1.5 1.5H4a2 2 0 0 1-2-2v-2.59A2 2 0 0 1 2.59 16l5.56-5.56A7.03 7.03 0 0 1 15 2a7 7 0 1 1-1.44 13.85l-1.7 1.71zm1.12-3.95l.58.18a5 5 0 1 0-3.34-3.34l.18.58L4 17.4V20h2v-.5c0-.83.67-1.5 1.5-1.5H8v-.5c0-.83.67-1.5 1.5-1.5h1.09l2.38-2.39zM18 9a1 1 0 0 1-2 0 1 1 0 0 0-1-1 1 1 0 0 1 0-2 3 3 0 0 1 3 3z"/></svg>
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
                                    مرا به خاطر بسپار
                                </label>
                            </label>

                            @if (Route::has('password.request'))
                                <p class="mr-auto text-left">
                                    <a href="{{ route('password.request') }}"
                                       class="text-blue text-xs no-underline hover:text-blue-dark">رمز عبورت را فراموش
                                        کرده‌ای؟</a>
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 text-center offset-md-4">
                            <button type="submit" class="button button--primary">
                                وارد حسابم شو
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
