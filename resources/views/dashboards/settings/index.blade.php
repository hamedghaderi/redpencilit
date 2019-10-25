@extends('layouts.dashboard')

@section('content')
    <div class="mb-12">
        <div class="w-full mb-6">
            <h3 class="dashboard-title">تنظیمات کلی مربوط به مقالات</h3>
            <p class="dashboard-text">
                در این قسمت تنظیمات کلی مقالات شامل قیمت و تعداد کلمات مجاز و حداکثر تعداد آپلود در روز تنظیم می‌شود .
            </p>
        </div>

        <div class="w-full">
            <div class="p-6 shadow rounded bg-white">
                <div class="flex items-center border-b border-grey-lighter pb-3 mb-3">
                    <h3>تنظیمات</h3>
                </div>

                <form class="w-full" method="POST" action="{{ $setting ? "/settings/{$setting->id}" : "/settings" }}">
                    @csrf

                    @if ($setting)
                        @method('PATCH')
                    @endif

                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label for="upload_articles_per_day" class="label">حداکثر تعداد آپلود مقاله در روز</label>

                            <input
                                    @input="sanitizeNumber"
                                    class="input"
                                    type="text"
                                    name="upload_articles_per_day"
                                    value="{{ $setting ? $setting->upload_articles_per_day : '' }}">

                            @if ($errors->has('upload_articles_per_day'))
                                <p class="feedback feedback--invalid my-2">
                                    {{ $errors->first('upload_articles_per_day') }}
                                </p>
                            @endif
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label for="upload_words_per_day" class="label">حداکثر تعداد کلمات قابل پذیرش
                                در
                                روز</label>

                            <input
                                    class="input"
                                    @input="sanitizeNumber"
                                    type="text"
                                    name="upload_words_per_day"
                                    value="{{ $setting ? $setting->upload_words_per_day : '' }}">

                            @if($errors->has('upload_words_per_day'))
                                <p class="feedback feedback--invalid my-2">
                                    {{ $errors->first('upload_words_per_day') }}
                                </p>
                            @endif
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label for="price_per_word" class="label">قیمت هر کلمه در واحد تومان</label>

                            <input
                                    @input="sanitizeNumber"
                                    class="input"
                                    type="text"
                                    name="price_per_word"
                                    value="{{ $setting ? $setting->price_per_word : '' }}">

                            @if ($errors->has('price_per_word'))
                                <p class="feedback feedback--invalid my-2">
                                    {{ $errors->first('price_per_word') }}
                                </p>
                            @endif
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label for="base_price_for_docs" class="label">قیمت پایه برای فایل‌های کم حجم
                                (تومان)</label>

                            <input
                                    @input="sanitizeNumber"
                                    class="input"
                                    type="text"
                                    name="base_price_for_docs"
                                    value="{{ $setting ? $setting->base_price_for_docs : '' }}">

                            @if($errors->has('base_price_for_docs'))
                                <p class="feedback feedback--invalid my-2">
                                    {{ $errors->first('base_price_for_docs') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <hr class="mb-6">

                    <div>
                        <button class="button button--primary" type="submit">ذخیره تنظیمات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection