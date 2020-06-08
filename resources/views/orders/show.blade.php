@extends('layouts.dashboard')

@section('content')
    <div class="py-12">
        <h1 class="dashboard-title mb-4">
            {{ __('Order details') }}
        </h1>
        <p class="dashboard-text mb-4">{{ __('Here you can find any progress of your documents. If there is any uploaded file you can find it here.') }}</p>

        <hr>

        <div class="card">
            <div class="flex">
                @if (app()->getLocale() === 'fa')
                    <p class="flex items-center text-grey-darkest">
                        <i class="la la-calendar text-xl text-grey-dark ml-2"></i>
                        {{ \Morilog\Jalali\Jalalian::fromCarbon($order->created_at)->format('%d %B، %Y') }}
                    </p>
                @else
                    <p class="text-grey-darkest">{{ $order->created_at->toDateString() }}</p>
                @endif
            </div>

            <hr>

            @forelse($order->replies as $reply)
                <a class="mb-8 flex items-center text-grey-darker hover:text-red cursor-pointer"
                    href="{{ route('order.reply.attachments', [app()->getLocale(), $reply]) }}">
                   <span class="flex bg-red-lightest w-12 h-12 items-center justify-center">
                       <i class="la la-download text-red text-xl"></i>
                   </span>

                    <span class="@if (app()->getLocale() === 'fa') mr-2 @else ml-2 @endif">
                        {{ $reply->original_name  }}
                    </span>
                </a>
            @empty
                <p>{{ __('There is no uploaded file yet.') }}</p>
            @endforelse
        </div>
    </div>
@endsection
