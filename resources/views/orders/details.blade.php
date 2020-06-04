<a class="text-indigo inline-flex items-center" href="#order-{{ $order->id }}">
    {{ __('Details') }}
</a>

<inner-modal name="order-{{ $order->id }}">
    <div class="flex flex-column flex-wrap">
        <div class="flex justify-between w-full border-b border-grey-light py-4">
            <span>{{ __('Status') }}</span>
            <span>
                 @if ($order->status === 1)
                    <span class="tag tag--warning">{{ __('Unfulfilled') }}</span>
                @elseif ($order->status === 2)
                    <span class="tag tag--primary">{{ __('Pending') }}</span>
                @else
                    <span class="tag tag--success">{{ __('Fulfilled') }}</span>
                @endif
            </span>
        </div>

        <div class="flex justify-between w-full border-b border-grey-light py-4">
            <span>{{ __('Delivery') }}</span>
            <span>{{ $order->delivery_date->diffForHumans() }}</span>
        </div>

        <div class="flex justify-between w-full border-b border-grey-light py-4">
            <span>{{ __('Cost') }}</span>
            <span>{{ $order->price }} تومان </span>
        </div>

        <div class="flex justify-between w-full border-b border-grey-light py-4">
            <span>{{ __('Words Count') }}</span>
            <span>{{ $order->total_words }} کلمه </span>
        </div>

        <div class="flex justify-between w-full border-grey-light pt-4 pb-1">
            <span>{{ __('Items') }}</span>
            <div>
                @foreach($order->details as $detail)
                    <div class="flex items-center justify-end mb-3">
                        <a
                                class="text-sm text-indigo"
                                href="{{ route('orders.attachment', [app()->getLocale(), $order, $detail]) }}">
                            دانلود
                        </a>
                        <p class="tag tag--info mr-2">{{ $detail->name }}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</inner-modal>
