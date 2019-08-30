@extends('layouts.dashboard')

@section('content')
    <h3 class="dashboard-title">لیست مستندات</h3>
    <p class="dashboard-text w-1/2 mb-12">لیست مقالات شامل تمامی مقالات تائید شده، پرداخت شده و تحویل گردیده می‌باشد
        .</p>

    <div class="flex flex-wrap">
        @forelse($orders as $order)
            <div class="px-6 w-1/3 mb-6">
                <div class="rounded p-6 shadow border-blue card-type-{{ $order->status }}">
                    <div class="card__doc-icon"
                         style="width:50px; height: 50px;">
                        <img class="w-1/2" src="/images/alert-document.svg" alt="vector
                       microsoft
                       word
                       icon">
                    </div>

                    <h4 class="card__title mb-6">{{ $order->orders_count }} فایل</h4>
                    <h4 class="card__price mb-3">{{ $order->price }} تومان</h4>

                    <div class="tags">
                        <span class="tag tag--transparent">{{ $order->total_words }} کلمه</span>
                        <span class="tag tag--transparent">{{ $order->service->name }}</span>
                    </div>
                </div>
            </div>
        @empty
            <p class="dashboard-title">هیچ مقاله‌ تائید نشده‌ای برای شما وجود ندارد.</p>
        @endforelse

    </div>
@endsection