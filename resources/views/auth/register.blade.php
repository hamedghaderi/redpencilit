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
                                <i class="la la-male text-2xl"></i>
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
                                <i class="las la-envelope text-2xl"></i>
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
                                <i class="la la-mobile text-2xl"></i>
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
                                <i class="la la-key text-2xl"></i>
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
                                <i class="la la-check-double text-2xl"></i>
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
