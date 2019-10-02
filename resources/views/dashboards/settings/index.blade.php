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
                <update-general-settings :setting="{{ $setting ? $setting : json_encode(null)
                }}"></update-general-settings>
            </div>
        </div>
    </div>
@endsection