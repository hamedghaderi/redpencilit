@extends('layouts.register-layout')

@section('content')
<div>
    <div class="w-1/3 mx-auto">
        <h2 class="text-white mb-5 text-center font-normal">ایجاد حساب کاربری</h2>
        <div class="card py-16">
            <form method="POST" action="/register" class="text-md" novalidate>
                @csrf

                <div class="form-group mb-4">
                    <div class="flex relative">
                        <input id="name" type="text" class="input border field-rtl w-full pl-12 rounded block{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="نام و نام خانوداگی" required autofocus>

                        <span class="input-icon">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>

                    @if ($errors->has('name'))
                        <div class="feedback feedback__invalid my-2" role="alert">
                            <p>{{ $errors->first('name') }}</p>
                        </div>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <div class="relative flex">
                        <input id="email" type="email" class="input field-rtl border w-full pl-12 rounded block{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="آدرس ایمیل">

                        <span class="input-icon">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>

                    @if ($errors->has('email'))
                        <div class="feedback feedback__invalid my-2" role="alert">
                            <p>{{ $errors->first('email') }}</p>
                        </div>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <div class="relative flex">
                        <input id="phone" type="text" class="input field-rtl border w-full pl-12 rounded block{{
                        $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}"
                               required placeholder="شماره تماس (موبایل)">

                        <span class="input-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </span>
                    </div>

                    @if ($errors->has('phone'))
                        <div class="feedback feedback__invalid my-2" role="alert">
                            <p>{{ $errors->first('phone') }}</p>
                        </div>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <div class="relative flex">
                        <input id="password" type="password" class="input field-rtl pl-12 border w-full rounded block{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="رمز عبور" required>

                        <span class="input-icon">
                            <i class="fas fa-lock"></i>
                        </span>
                    </div>

                    @if ($errors->has('password'))
                        <div class="feedback feedback__invalid my-2" role="alert">
                            <p>{{ $errors->first('password') }}</p>
                        </div>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <div class="relative flex">
                        <input id="password-confirm" type="password" class="input pl-12 field-rtl border w-full rounded block" name="password_confirmation" required placeholder="تکرار رمز عبور">

                        <span class="input-icon">
                            <i class="fas fa-redo"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
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
   @include('partials.form');
@endsection
