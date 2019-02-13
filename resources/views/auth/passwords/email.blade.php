@extends('layouts.forgot-layout')

@section('content')
<div>
    <div class="w-2/5 mx-auto">
        <div class="card">
            <h2 class="font-normal mb-3 pb-6 border-b border-grey-lighter">رمز عبورتان را فراموش کرده‌اید؟</h2>

            <p class="text-sm mb-6 leading-normal">نگران نباشید! ایمیلتان را در قسمت زیر وارد کنید تا به شما کمک کنیم آن را باز پس بگیرید.</p>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" novalidate>
                    @csrf

                    <div class="form-group mb-4">
                        <div class="flex relative">
                            <input id="email" type="email" class="input w-full field-rtl pl-12 rounded block{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="آدرس ایمیل">

                            <span class="input-icon">
                                <i class="far fa-envelope"></i>
                            </span>
                        </div>

                        @if ($errors->has('email'))
                            <div class="feedback feedback__invalid my-2" role="alert">
                                <p>{{ $errors->first('email') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="flex items-center">
                            <button type="submit" class="button button--default">
                                پسورد جدیدی برایم ایجاد کن
                            </button>

                            <a href="{{ route('login') }}" type="submit" class="button button--default mr-auto">
                                منصرف شدم
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
