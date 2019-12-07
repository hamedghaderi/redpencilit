@extends('layouts.dashboard')

@section('content')
    <h3 class="dashboard-title">لیست مستندات</h3>
    <p class="dashboard-text w-1/2 mb-12">لیست مقالات شامل تمامی مقالات تائید شده، پرداخت شده و تحویل گردیده می‌باشد
        .</p>

    <div class="flex flex-wrap">
        @forelse($orders as $order)
            <div class="px-6 w-1/3 mb-6">
                <div class="rounded shadow card-type-{{ $order->status }}">
                    <div class="flex items-center mb-6 font-bold p-6">
                        <span class="text-sm mr-2">
                            {{ $order->status === 1 ? 'در سبد پرداخت' : '' }}
                            {{ $order->status === 2 ? 'در حال ویرایش' : '' }}
                            {{ $order->status === 3 ? 'پروژه‌های به اتمام رسیده' : '' }}
                        </span>

                        <span class="text-xs mr-auto font-light">
                            {{ $order->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <div class="mb-6 flex px-6">
                        <div>
                            <i class="far fa-file text-xs"></i>
                            <span class="text-xs mr-1">{{ $order->orders_count }} فایل</span>
                        </div>

                        <div class="mr-4">
                            <i class="far fa-file-word text-xs"></i>
                            <span class="text-xs mr-1">{{ $order->total_words }} کلمه</span>
                        </div>

                        <div class="mr-4">
                            <i class="far fa-folder-open text-xs"></i>
                            <span class="text-xs mr-1">{{ $order->service->name }}</span>
                        </div>
                    </div>

                    <div class="card__separator"></div>

                    <div class="tags px-6 pb-6 pt-3 {{ $order->status === 1 ? "flex items-center" : '' }}">
                        <span class="tag tag--white">{{ $order->price }} تومان</span>

                        @if ($order->status === 1)
                            <button type="button" class="button button--primary button--sm mr-auto">پرداخت</button>
                        @endif
                    </div>
                </div>

            </div>
        @empty
            <p class="dashboard-title">
                هنوز هیچ مقاله‌ای ارسال نشده است.
                <a href="{{ route('new-order', app()->getLocale()) }}">ارسال اولین مقاله</a>
            </p>
        @endforelse
    </div>
@endsection