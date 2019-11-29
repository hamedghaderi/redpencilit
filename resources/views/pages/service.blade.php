@extends('layouts.master')

@section('content')
   <div class="px-32">
      <h2 class="title mb-12">خدمات</h2>

      <div class="flex flex-wrap -mx-12">
         <div class="px-8 w-full mb-8 md:w-1/3">
            <div class="bg-white rounded shadow p-8 text-center pb-12">
               <img class="w-1/2" src="{{ asset('images/third-service.svg') }}" alt="pencil and board vector">
               <h3 class="text-grey-dark mb-4">سرویس سوم</h3>
               <ul class="list-reset text-center mx-auto text-grey-dark">
                  <li class="mb-4"><span class="inline-flex w-2 h-2 bg-teal-light ml-2 rounded-full"></span>آیتم ۱</li>
                  <li class="mb-4"><span class="inline-flex w-2 h-2 bg-teal-light ml-2 rounded-full"></span>آیتم ۲</li>
                  <li><span class="inline-flex w-2 h-2 bg-teal-light ml-2 rounded-full"></span>آیتم ۳</li>
               </ul>
            </div>
         </div>

         <div class="px-8 w-full mb-8 md:w-1/3">
            <div class="bg-white rounded shadow p-8 text-center pb-12">
               <img class="w-1/2" src="{{ asset('images/second-service.svg') }}" alt="pencil and board vector">
               <h3 class="text-grey-dark mb-4">سرویس دوم</h3>
               <ul class="list-reset text-center mx-auto text-grey-dark">
                  <li class="mb-4"><span class="inline-flex w-2 h-2 bg-teal-light ml-2 rounded-full"></span>آیتم ۱</li>
                  <li class="mb-4"><span class="inline-flex w-2 h-2 bg-teal-light ml-2 rounded-full"></span>آیتم ۲</li>
                  <li><span class="inline-flex w-2 h-2 bg-teal-light ml-2 rounded-full"></span>آیتم ۳</li>
               </ul>
            </div>
         </div>

         <div class="px-8 w-full md:w-1/3">
            <div class="bg-white rounded shadow p-8 text-center pb-12">
               <img class="w-1/2" src="{{ asset('images/first-service.svg') }}" alt="pencil and board vector">
               <h3 class="text-grey-dark mb-4">سرویس اول</h3>
               <ul class="list-reset text-center mx-auto text-grey-dark">
                  <li class="mb-4"><span class="inline-flex w-2 h-2 bg-teal-light ml-2 rounded-full"></span>آیتم ۱</li>
                  <li class="mb-4"><span class="inline-flex w-2 h-2 bg-teal-light ml-2 rounded-full"></span>آیتم ۲</li>
                  <li><span class="inline-flex w-2 h-2 bg-teal-light ml-2 rounded-full"></span>آیتم ۳</li>
               </ul>
            </div>
         </div>
      </div>
   </div>
@endsection