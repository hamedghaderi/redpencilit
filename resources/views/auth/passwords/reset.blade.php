@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="mt-24 w-full sm:w-3/4 md:w-2/3 lg:w-2/5 mx-auto">
            <div class="card">
                <h2 class="text-center text-grey-darkest mb-4">{{ __('Reset Password') }}</h2>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update', app()->getLocale()) }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group mb-6">
                            <div class="flex relative">
                                <input id="email"
                                       type="email"
                                       placeholder="{{ __('email') }}"
                                       class="input w-full field-rtl pl-12 rounded block{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email"
                                       value="{{ $email ?? old('email') }}" required autofocus>

                                <span class="input-icon">
                                    <i class="la la-envelope text-2xl"></i>
                                </span>

                                @if ($errors->has('email'))
                                    <div class="feedback feedback--invalid my-2" role="alert">
                                        <p>{{ $errors->first('email') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-6">
                            <div class="flex relative">
                                <input id="password"
                                       type="password"
                                       class="input w-full field-rtl pl-12 rounded block {{ $errors->has('password') ?
                                        'is-invalid' : ''
                                        }}"
                                       placeholder="{{ __('password') }}"
                                       name="password" required>

                                <span class="input-icon">
                                    <i class="la la-key text-2xl"></i>
                                </span>

                                @if ($errors->has('password'))
                                    <div class="feedback feedback--invalid my-2" role="alert">
                                        <p>{{ $errors->first('password') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-6">
                            <div class="flex relative">
                                <input id="password-confirm"
                                       type="password"
                                       class="input field-rtl pl-12 rounded block"
                                       placeholder="{{ __('confirm password') }}"
                                       name="password_confirmation"
                                       required>

                                <span class="input-icon">
                                    <i class="la la-check-double text-2xl"></i>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="button button--primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
