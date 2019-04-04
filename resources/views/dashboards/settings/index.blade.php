@extends('layouts.dashboard')

@section('content')
   <div class="mb-12">
      <div class="w-full mb-6">
         <h3 class="dashboard-title">تنظیمات کلی مربوط به مقالات</h3>
         <p class="dashboard-text">در این قسمت تنظیمات کلی مقالات شامل قیمت و تعداد کلمات مجاز و حداکثر تعداد آپلود در روز تنظیم می‌شود
            .</p>
      </div>

      <div class="w-full">
         <div class="p-6 shadow rounded bg-white">
            <form action="{{
                    $setting ?
                    '/dashboard/' . auth()->user()->username . '/settings/1' :
                    '/dashboard/' .auth() ->user()->username . '/settings'
               }}"
                  method="POST">

               @csrf

               @if($setting)
                  @method('PATCH')
               @endif

               <update-general-settings
                  upload_articles_per_day="{{ $setting ? $setting->upload_articles_per_day : '' }}"
                  upload_words_per_day="{{ $setting ? $setting->upload_words_per_day : '' }}"
                  price_per_word="{{ $setting ? $setting->price_per_word : '' }}"
                  base_price_for_docs="{{ $setting ? $setting->base_price_for_docs : '' }}"
               ></update-general-settings>
            </form>
         </div>
      </div>
   </div>
@endsection