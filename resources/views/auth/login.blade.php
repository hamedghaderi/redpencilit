@extends('layouts.auth')

@section('content')
<div>
    <div class="w-1/3 mx-auto">
        <h2 class="text-white mb-3 text-center font-normal">ورود به حساب کاربری</h2>
        <p class="text-white text-center mb-12">خوش آمدید</p>
        <div class="card py-16">
            <form method="POST" action="{{ route('login') }}" class="text-md" novalidate>
                @csrf

                <div class="form-group mb-4">
                    <div>
                        <div class="flex relative">
                            <input id="email" type="email" class="input w-full field-rtl pl-12 rounded block{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="آدرس ایمیل">

                            <span class="input-icon">
                                <i class="far fa-envelope"></i>
                            </span>
                        </div>

                        @if ($errors->has('email'))
                            <div class="feedback feedback__invalid my-2">
                                <p>
                                    {{ $errors->first('email') }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>



                <div class="form-group mb-4">
                    <div>
                        <div class="flex relative">
                            <input id="password" type="password" class="input w-full field-rtl pl-12 rounded block{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="رمز عبور">

                            <span class="absolute pin-l h-full border bg-white rounded-tl rounded-bl flex items-center px-3 text-grey">
                                <i class="fas fa-key"></i>
                            </span>
                        </div>

                        @if ($errors->has('password'))
                            <div class="feedback feedback__invalid my-2">
                                <p>
                                    {{ $errors->first('password') }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group mb-6">
                    <div class="w-full p-2 flex items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="text-grey-darker text-sm" for="remember">
                                مرا به خاطر بسپار
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <p class="mr-auto text-left">
                                <a href="{{ route('password.request') }}" class="text-blue text-xs no-underline hover:text-blue-dark">رمز عبورت را فراموش کرده‌ای؟</a>
                            </p>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 text-center offset-md-4">
                        <button type="submit" class="button button--primary ml-3">
                            وارد حسابم شو
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
