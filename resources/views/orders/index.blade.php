@extends('layouts.dashboard')

@section('content')
    <div class="p-4">
        <h3 class="dashboard-title">{{ __('Orders') }}</h3>
    </div>

    <div class="p-4 mb-12">
        @include('orders.filter')

        <header class="flex text-grey text-sm w-full items-center mb-0 p-4">
            <span class="w-24">{{ __('Order ID') }}</span>
            <span class="w-32">{{ __('Date') }}</span>
            <span class="w-32">{{ __('Status') }}</span>
            <span class="w-32">{{ __('Delivery') }}</span>
            <span class="w-32">{{__('Cost')}}</span>
            <span class="w-24">{{ __('Paid') }}</span>
            <span class="w-32">{{ __('Fulfill Order') }}</span>
        </header>

        @foreach($user->orders as $order)
            <div class="flex items-center bg-white shadow rounded p-4 mb-4 text-sm text-grey-darker">
                <div class="w-24">{{ $order->id }}</div>
                <div class="w-32">{{ $order->created_at->diffForHumans() }}</div>
                <div class="w-32">
                    @if ($order->status === 1)
                        <span class="tag tag--warning">{{ __('Unfulfilled') }}</span>
                    @elseif ($order->status === 2)
                        <span class="tag tag--primary">{{ __('Pending') }}</span>
                    @else
                        <span class="tag tag--success">{{ __('Fulfilled') }}</span>
                    @endif
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
                <div class="w-32">
                    @if (! $order->payed)
                        <form action="{{ route('orders.store', [app()->getLocale(), $order]) }}" method="POST">
                            @csrf

                            <button type="submit" class="button button--primary button--thin">
                                {{ __('Pay') }}
                            </button>
                        </form>
                    @endif
                </div>

                <div class="text-xs">
                    @include('orders.details')
                </div>
            </div>
        @endforeach
    </div>
@endsection
