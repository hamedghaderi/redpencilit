@extends('layouts.dashboard')

@section('content')
    <h3 class="dashboard-title">لیست مستندات تائید نشده</h3>
    <p class="dashboard-text w-1/2 mb-12">لیست مقالات تائید نشده شامل مقالاتی است که آپلود شده‌اند اما هنوز هیچگونه
        پرداختی
        بابت آن
        انجام نشده و یا از
        گزینه توافقی استفاده شده است. لذا نیاز به توافق طرفین برای انجام دارد.</p>

    <div class="flex flex-wrap">
        @forelse($documents as $document)
            <div class="px-6 w-1/3 mb-6">
               <div class="bg-white rounded p-6 shadow border-b-2 border-blue">
                   <div class="bg-blue-lightest w-25 rounded-full text-center relative mb-6"
                        style="width:50px; height: 50px;">
                       <img class="w-1/2 absolute-center" src="/images/alert-document.svg" alt="vector
                       microsoft
                       word
                       icon">
                   </div>

                   <h4 class="dashboard-title mb-6">{{ $document->name }}</h4>

                   <div class="tags">
                       <span class="tag tag--info">{{ $document->words }} کلمه</span>
                       <span class="tag tag--success">{{ $document->service->name }}</span>
                   </div>
               </div>
            </div>
       @empty
           <p class="dashboard-title">هیچ مقاله‌ تائید نشده‌ای برای شما وجود ندارد.</p>
       @endforelse

    </div>
@endsection