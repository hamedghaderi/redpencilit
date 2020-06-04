<div class="bg-white rounded shadow p-8 pb-24">
    <header class="mb-6 pb-2 border-b text-grey-darker text-grey-darker text-sm">
        <ul class="flex list-reset">
            <li class="w-64">{{ __('Description') }}</li>
            <li class="w-32">{{ __('Quantity') }}</li>
            <li class="w-24">{{ __('Amount') }}</li>
        </ul>
    </header>

    <div class="text-grey-darker border-b mb-6 pb-2">
        <div class="flex text-sm">
            <div class="w-64">
                @foreach($order->details as $detail)
                    <div class="mb-2">
                        <a class="text-grey-dark inline-flex items-center hover:text-indigo"
                           href="{{ route('orders.attachment', [app()->getLocale(), $order, $detail])  }}">
                            <i class="las la-save text-lg"></i>
                            {{ $detail->name }}
                        </a>
                    </div>
                @endforeach
            </div>

            <span class="w-32">{{ $order->orders_count }}</span>
            <span>{{ $order->price . ' ' . __('Tomans') }}</span>
        </div>
    </div>

    <div class="flex text-sm w-full items-center">
        <div> {{ __('Status') }}:
            @if ($order->payed)
                <span class="tag tag--success">{{ __('Paid') }}</span>
            @else
                <span class="tag tag--info">{{ __('Draft') }}</span>
            @endif
        </div>

        <div class="mr-auto flex items-center">
            {{ __('Level') }}:
            <select-tag :status="{{ $order->status }}" order_id="{{ $order->id }}"></select-tag>
        </div>
    </div>
</div>
