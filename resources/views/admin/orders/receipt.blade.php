<div class="bg-white rounded p-8 pb-12 shadow">
    <h2 class="text-center text-grey-darker text-base border-b border-grey-lighter pb-8 mb-4">
        {{ __('Invoice number ') . $order->id }}
    </h2>

    <div class="flex mb-4 border-b border-grey-lighter pb-4">
        <div class="flex justify-between w-full">
            <ul class="list-reset text-sm">
                <li class="text-grey mb-2">{{ __('Issue Date') }}</li>
                <li class="text-grey-darkest">{{ $order->updated_at->diffForHumans() }}</li>
            </ul>

            <ul class="list-reset text-sm">
                <li class="text-grey mb-2">{{ __('Delivery Date') }}</li>
                <li class="text-grey-darkest">{{ $order->delivery_date->diffForHumans() }}</li>
            </ul>
        </div>
    </div>

    <div>
        <h3 class="text-grey text-sm font-normal mb-8">{{ __('Payment Owner') }}</h3>

        <div class="text-sm mb-3">
                        <span class="text-grey inline-flex inline-flex items-center w-24">
                            {{ __('Contract') }}:
                        </span>
            <a class="text-indigo underline hover:text-indigo-dark" href="{{ route('admin.users.index', app()
                        ->getLocale()) }}">
                {{ $order->owner->name }}
            </a>
        </div>

        <div class="text-sm mb-3">
                        <span class="text-grey inline-flex items-center w-24">
                            {{ __('Email') }}:
                        </span>
            <span class="text-grey-darker">
                            {{ $order->owner->email }}
                        </span>
            <span class=""></span>
        </div>
    </div>
</div>
