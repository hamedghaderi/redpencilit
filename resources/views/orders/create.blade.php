@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="upload-levels">
            <h3 class="upload-levels__title">آپلود مستندات</h3>

            <ul class="upload-levels__list">
                <li class="upload-levels__item upload-levels__item--active">
                    <span class="upload-levels__marker"></span>

                    <div class="upload-levels__content">
                        <span>مرحله ۱</span>
                        آپلود مستندات
                    </div>
                </li>
                <li class="upload-levels__item">
                    <span class="upload-levels__marker"></span>

                    <div class="upload-levels__content">
                        <span>مرحله ۲</span>
                        ثبت نام
                    </div>
                </li>
                <li class="upload-levels__item">
                    <span class="upload-levels__marker"></span>

                    <div class="upload-levels__content">
                        <span>مرحله ۳</span>
                        نهایی کردن اطلاعات
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection