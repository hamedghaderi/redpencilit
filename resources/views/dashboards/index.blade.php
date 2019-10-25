@extends('layouts.dashboard')

@section('content')
    <div class="flex mb-12">
        <div class="w-full">
            <div class="p-6">
                <div class="bg-white shadow p-6 rounded mb-12">
                    <form action="{{ '/dashboard/' . $user->id }}" method="POST" class="w-full">
                        @csrf
                        @method('PATCH')

                        <div class="flex items-center border-b border-grey-lighter pb-3 mb-3">
                            <h3 class="text-base md:text-lg text-grey-darker">
                                <span class="text-grey ml-1">
                                    <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 24 24" width="24"
                                         height="24"><path
                                                class="heroicon-ui"
                                                d="M9 12A5 5 0 1 1 9 2a5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm8 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h5a5 5 0 0 1 5 5v2zm-1.3-10.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/></svg>
                                </span>
                                اطلاعات حساب
                            </h3>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 lg:w-1/3 px-3 pb-6">
                                <label for="name" class="label">نام</label>
                                <input
                                        type="text"
                                        id="name"
                                        value="{{ $user->name }}"
                                        name="name"
                                        class="input">

                                @if ($errors->has('name'))
                                    <div class="feedback feedback--invalid mt-1">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>

                            <div class="w-full md:w-1/2 lg:w-1/3 px-3 pb-6">
                                <label for="email" class="label">آدرس ایمیل</label>
                                <input
                                        id="email"
                                        class="input"
                                        type="email"
                                        name="email"
                                        value="{{ $user->email }}">

                                @if ($errors->has('email'))
                                    <div class="feedback feedback--invalid mt-1">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>

                            <div class="w-full md:w-1/2 lg:w-1/3 px-3">
                                <label for="mobile" class="label">شماره تماس (موبایل)</label>
                                <input
                                        id="mobile"
                                        class="input"
                                        type="text"
                                        name="phone"
                                        value="{{ $user->phone }}">

                                @if ($errors->has('phone'))
                                    <div class="feedback feedback--invalid mt-1">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <hr class="mb-3">

                        <div class="row">
                            <button @click="" class="button button--primary">ذخیره اطلاعات</button>
                        </div>

                    </form>
                </div>

                <div class="bg-white shadow p-6 rounded">
                    <form action="{{ $user->details ? "/users/" . $user->id . "/details" : '/details' }}" method="POST"
                          class="w-full">
                        @csrf

                        @if ($user->details)
                            @method('PATCH')
                        @endif


                        <div class="flex items-center border-b border-grey-lighter pb-3 mb-3">
                            <h3>اطلاعات تکمیلی</h3>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">

                            <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-6">
                                <label for="country" class="label">کشور محل اقامت</label>
                                <div class="select">
                                    <select name="country_id" id="country">
                                        <option value="">نام کشور</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" {{ ($user->details &&
                                            $user->details->country_id == $country->id) ? 'selected' : ''
                                             }}>
                                                {{ $country->name[app()->getLocale()] }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div class="select__icon">
                                        <svg class="select__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                        </svg>
                                    </div>
                                </div>

                                @if ($errors->has('country_id'))
                                    <div class="feedback feedback--invalid">
                                        {{ $errors->first('country_id') }}
                                    </div>
                                @endif
                            </div>

                            <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-6">
                                <label for="college" class="label">دانشگاه</label>
                                <input
                                        id="college"
                                        class="input"
                                        type="text"
                                        value="{{ $user->details ? $user->details->college : '' }}"
                                        name="college">

                                @if ($errors->has('college'))
                                    <div class="feedback feedback--danger">
                                        {{ $errors->first('college') }}
                                    </div>
                                @endif
                            </div>

                            <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-6">
                                <label for="field" class="label">رشته تحصیلی</label>

                                <input
                                        id="field"
                                        class="input"
                                        type="text"
                                        value="{{ $user->details ? $user->details->field : '' }}"
                                        name="field">

                                @if ($errors->has('field'))
                                    <div class="feedback feedback--invalid">
                                        {{ $errors->first('field') }}
                                    </div>
                                @endif
                            </div>

                            <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-6 md:mb-0">
                                <label for="degree_id" class="label">مقطع تحصیلی</label>

                                <div class="select">
                                    <select name="degree_id" id="degree_id">
                                        <option value="">مقطع تحصیلی</option>
                                        @foreach ($degrees as $degree)
                                            <option value="{{ $degree->id }}"
                                                    {{ ($user->details && $user->details->degree_id == $degree->id) ?
                                                    'selected'
                                                    : '' }}>
                                                {{ $degree->name[app()->getLocale()] }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div class="select__icon">
                                        <svg class="select__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full sm:w-ful lg:w-2/3 px-3 mb-6 md:mb-0">
                                <label for="address" class="label">آدرس</label>
                                <input
                                        class="input"
                                        type="text"
                                        name="address"
                                        id="address"
                                        value="{{ $user->details ? $user->details->address : '' }}">
                            </div>
                        </div>

                        <hr class="mb-3">

                        <div class="row">
                            <button class="button button--primary">ذخیره اطلاعات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection






