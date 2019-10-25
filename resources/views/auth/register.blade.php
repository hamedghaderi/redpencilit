@extends('layouts.auth')

@section('nav-link')
    <a href="{{ route('login') }}" class="block text-grey-darker text-sm rounded py-1 mb-1 sm:mb-0
                sm:mr-2 px-2
                hover:bg-grey-light sm:hidden">قبلا حساب ایجاد کرده‌ام</a>
    <a href="{{ route('login') }}"
       class="hidden sm:block
                button
                button--info
                py-1
                mb-1
                sm:mb-0
                sm:mr-2
                px-4">قبلا حساب ایجاد کرده‌ام</a>
@endsection

@section('content')
    <div class="container">
        <div class="w-full sm:w-3/4 md:w-2/3 lg:w-2/5 mx-auto">
            <div class="card mt-16">
                <h2 class="text-lg md:text-2xl font-bold text-grey-darker mb-4 text-center font-normal">ایجاد حساب کاربری</h2>

                <p class="text-grey text-sm text-center mb-6 leading-loose">با ایجاد حساب کاربری و فعالسازی آن‌
                    می‌توانید سفارشات
                    خود را
                    هر چه سریعتر برای ما ارسال کنید.</p>

                <form method="POST" action="/register" class="text-md w-full" novalidate>
                    @csrf

                    <div class="mb-4">
                        <div class="flex relative">
                            <input id="name" type="text"
                                   class="input field-rtl pl-12 rounded {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name" value="{{ old('name') }}" placeholder="نام و نام خانوداگی" required
                                   autofocus>

                            <span class="input-icon">
                               <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    width="24"
                                     height="24"><path class="heroicon-ui" d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z"/></svg>
                            </span>
                        </div>

                        @if ($errors->has('name'))
                            <div class="feedback feedback--invalid my-2" role="alert">
                                <p>{{ $errors->first('name') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <div class="relative flex">
                            <input id="email" type="email"
                                   class="input field-rtl pl-12 {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="email" value="{{ old('email') }}" required placeholder="آدرس ایمیل">

                            <span class="input-icon">
                               <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    width="24"
                                     height="24"><path class="heroicon-ui" d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"/></svg>
                            </span>
                        </div>

                        @if ($errors->has('email'))
                            <div class="feedback feedback--invalid my-2" role="alert">
                                <p>{{ $errors->first('email') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <div class="relative flex">
                            <input id="phone"
                                   type="text"
                                   class="input field-rtl pl-12
                                            {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   required
                                   placeholder="شماره تماس (موبایل)"
                                   @input="changeToEnglish"
                            >

                            <span class="input-icon">
                                <svg class="fill-current w-5 x-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24
                                24" width="24"
                                      height="24"><path class="heroicon-ui" d="M8 2h8a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2zm0 2v16h8V4H8zm4 14a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></svg>
                            </span>
                        </div>

                        @if ($errors->has('phone'))
                            <div class="feedback feedback--invalid my-2" role="alert">
                                <p>{{ $errors->first('phone') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <div class="relative flex">
                            <input id="password"
                                   type="password"
                                   class="input field-rtl pl-12
                                        {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password"
                                   placeholder="رمز عبور"
                                   required>

                            <span class="input-icon">
                                <svg class="fill-current w-5 x-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24
                                24"
                                     width="24"
                                      height="24"><path class="heroicon-ui" d="M11.85 17.56a1.5 1.5 0 0 1-1.06.44H10v.5c0 .83-.67 1.5-1.5 1.5H8v.5c0 .83-.67 1.5-1.5 1.5H4a2 2 0 0 1-2-2v-2.59A2 2 0 0 1 2.59 16l5.56-5.56A7.03 7.03 0 0 1 15 2a7 7 0 1 1-1.44 13.85l-1.7 1.71zm1.12-3.95l.58.18a5 5 0 1 0-3.34-3.34l.18.58L4 17.4V20h2v-.5c0-.83.67-1.5 1.5-1.5H8v-.5c0-.83.67-1.5 1.5-1.5h1.09l2.38-2.39zM18 9a1 1 0 0 1-2 0 1 1 0 0 0-1-1 1 1 0 0 1 0-2 3 3 0 0 1 3 3z"/></svg>
                            </span>
                        </div>

                        @if ($errors->has('password'))
                            <div class="feedback feedback--invalid my-2" role="alert">
                                <p>{{ $errors->first('password') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <div class="relative flex">
                            <input id="password-confirm"
                                   type="password"
                                   class="input pl-12 field-rtl border w-full rounded block"
                                   name="password_confirmation"
                                   required
                                   placeholder="تکرار رمز عبور">

                            <span class="input-icon">
                                <svg class="fill-current w-5 x-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24
                                24"
                                     width="24"
                                      height="24"><path class="heroicon-ui" d="M5.41 16H18a2 2 0 0 0 2-2 1 1 0 0 1 2 0 4 4 0 0 1-4 4H5.41l2.3 2.3a1 1 0 0 1-1.42 1.4l-4-4a1 1 0 0 1 0-1.4l4-4a1 1 0 1 1 1.42 1.4L5.4 16zM6 8a2 2 0 0 0-2 2 1 1 0 0 1-2 0 4 4 0 0 1 4-4h12.59l-2.3-2.3a1 1 0 1 1 1.42-1.4l4 4a1 1 0 0 1 0 1.4l-4 4a1 1 0 0 1-1.42-1.4L18.6 8H6z"/></svg>
                            </span>
                        </div>
                    </div>

                    <div>
                        <div class="col-md-8 text-center offset-md-4">
                            <button type="submit" class="button button--primary ml-3">
                                ایجاد حساب
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('partials.rtl-input')
@endsection
