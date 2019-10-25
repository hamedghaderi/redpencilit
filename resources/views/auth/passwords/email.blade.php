@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="mt-24 w-full sm:w-3/4 md:w-2/3 lg:w-2/5 mx-auto">
            <div class="card">
                <h2 class="text-center text-grey-darkest mb-4">رمز عبورتان را فراموش کرده‌اید؟</h2>

                <p class="text-sm text-center leading-loose text-grey mb-6">نگران نباشید! ایمیلتان را در قسمت زیر
                    وارد کنید تا
                    به شما کمک
                    کنیم آن را باز پس بگیرید.</p>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" novalidate>
                        @csrf

                        <div class="form-group mb-6">
                            <div class="flex relative">
                                <input id="email" type="email"
                                       class="input w-full field-rtl pl-12 rounded block{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email" value="{{ old('email') }}" required placeholder="آدرس ایمیل">

                                <span class="input-icon">
                                     <svg class="fill-current w-5 h-5"
                                          xmlns="http://www.w3.org/2000/svg"
                                          viewBox="0 0 24 24"
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

                        <div class="form-group">
                            <div class="flex items-center">
                                <button type="submit" class="button button--primary py-2 px-3">
                                    پسورد جدیدی برایم ایجاد کن
                                </button>

                                <a href="{{ route('login') }}" class="button button--neutral
                                shadow-none hover:shadow-none
                                mr-auto py-2 px-3">
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
