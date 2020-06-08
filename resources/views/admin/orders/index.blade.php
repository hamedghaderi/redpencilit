@extends('layouts.dashboard')

@section('content')
    <h3 class="dashboard-title">{{ __('Orders List') }}</h3>

    <p class="dashboard-text w-1/2 mb-12">
        {{ __('List of all orders, containing paid and unpaid.') }}
    </p>

    <div class="bg-indigo-lightest rounded px-12 py-8">
        <form method="GET" action="{{ route('admin.orders.index', app()->getLocale()) }}">
            <h4 class="text-indigo mb-4">فیلتر کردن سفارشات بر اساس</h4>

            <hr class="border-indigo-lighter">

            <div class="lg:flex w-full">
                <div class="select ml-24 flex items-center mb-8 lg:mb-0">
                    <label class="label ml-4">وضعیت</label>
                    <select name="status">
                        <option value="">وضعیت</option>
                        <option value="unfulfilled"
                               @if (request('status') === 'unfulfilled') selected @endif>
                            {{ __('Unfulfilled') }}
                        </option>
                        <option value="pending"
                                @if (request('status') === 'pending') selected @endif>
                            {{ __('Pending') }}
                        </option>
                        <option value="fulfilled"
                                @if (request('status') === 'fulfilled') selected @endif>
                            {{ __ ('Fulfilled') }}
                        </option>
                    </select>

                    <div class="select__icon">
                        <i class="la la-angle-down text-sm"></i>
                    </div>
                </div>

                <div class="flex items-center mb-8 lg:mb-0">
                    <label class="label min-w-24" for="delivery-date">تاریخ تحویل تا</label>
                    <input class="input w-16 mr-4"
                           type="text"
                           name="delivery_date"
                           placeholder="1"
                           value="{{ request('delivery_date') ?? '' }}">
                    <label class="label mr-4">روز دیگر </label>
                </div>

                <button type="submit"
                        class="button button--indigo mr-auto text-white bg-indigo cursor-pointer">
                    اعمال فیلتر
                </button>
            </div>
        </form>
    </div>


    <div class="p-4 mb-12">
        <div class="overflow-x-scroll">
            <header class="flex text-grey border-b text-sm w-full items-center mb-4 p-4"
                    style="min-width: 992px;">
                <span class="w-24">{{ __('Order ID') }}</span>
                <span class="w-24">{{ __('User Name') }}</span>
                <span class="w-32">{{ __('Date') }}</span>
                <span class="w-32">{{ __('Status') }}</span>
                <span class="w-32">{{ __('Delivery') }}</span>
                <span class="w-32">{{__('Cost')}}</span>
                <span class="w-24">{{ __('Paid') }}</span>
                <span class="w-24">{{ __('Reply') }}</span>
            </header>

            @foreach($orders as $order)
                <div class="flex items-center bg-white shadow rounded p-4 mb-4 text-sm
                text-grey-darker" style="min-width: 992px;">
                    <div class="w-24">{{ $order->id }}</div>
                    <div class="w-24">{{ $order->owner->name }}</div>
                    <div class="w-32">{{ $order->created_at->diffForHumans() }}</div>
                    <div class="w-32">
                        <status :status="{{ $order->status }}"></status>
{{--                        <select-tag :status="{{ $order->status }}"--}}
{{--                                    order_id="{{ $order->id }}"></select-tag>--}}
                    </div>
                    <div class="w-32">{{ $order->delivery_date->diffForHumans() }}</div>
                    <div class="w-32">{{ $order->price }} {{ __('Tomans') }}</div>
                    <div class="w-24">
                        @if ($order->payed)
                            <img class="w-5" src="{{ asset('images/check.svg') }}" alt="check icon">
                        @else
                            <i class="las la-thumbs-down text-xl text-grey"></i>
                        @endif
                    </div>

                    <div class="w-24">
                        <a class="text-grey-dark underline"
                           href="{{ route('admin.orders.reply', [app()->getLocale(), $order]) }}">
                            {{ __('Upload Reply') }}
                        </a>
                    </div>

                    <div class="text-xs text-center w-24">
                        <a class="text-grey-dark underline"
                           href="{{ route('admin.orders.show', [app() ->getLocale (), $order->id]) }}">
                            {{ __('Details') }}
                        </a>
                    </div>
                </div>
            @endforeach

            {{ $orders->links() }}
        </div>
    </div>
@endsection
