@extends('layouts.dashboard')

@section('content')
    <h3 class="dashboard-title">{{ __('Orders List') }}</h3>
    <p class="dashboard-text w-1/2 mb-12">
        {{ __('List of all orders, containing paid and unpaid.') }}
    </p>

    <div class="p-4 mb-12">
        <header class="flex text-grey border-b text-sm w-full items-center mb-4 p-4">
            <span class="w-24">{{ __('Order ID') }}</span>
            <span class="w-24">{{ __('User Name') }}</span>
            <span class="w-24">{{ __('Date') }}</span>
            <span class="w-48">{{ __('Status') }}</span>
            <span class="w-32">{{ __('Delivery') }}</span>
            <span class="w-32">{{__('Cost')}}</span>
            <span class="w-24">{{ __('Paid') }}</span>
        </header>

        @foreach($orders as $order)
            <div class="flex items-center bg-white shadow rounded p-4 mb-4 text-sm text-grey-darker">
                <div class="w-24">{{ $order->id }}</div>
                <div class="w-24">{{ $order->owner->name }}</div>
                <div class="w-24">{{ $order->created_at->diffForHumans() }}</div>
                <div class="w-48">
                   <select-tag :status="{{ $order->status }}" order_id="{{ $order->id }}"></select-tag>
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

                <div class="text-xs">
                   <a href="{{ route('admin.orders.show', [app()->getLocale(), $order->id]) }}"
                      class="text-indigo">{{ __('Details')
                   }}</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
