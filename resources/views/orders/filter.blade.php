<div class="">
    <div class="flex border-b mb-4">
        <a
                class="ml-8 pb-4 text-grey-dark font-bold border-b border-transparent {{ !request('type') ? 'text-indigo border-indigo' : '' }}"
                href="{{ route('users.orders.index', [app()->getLocale(), auth()->user ()]) }}"
        >
            {{ __ ('All') }}
        </a>

        <a
                class="ml-8 pb-4 text-grey-dark font-bold border-b border-transparent
                {{ request('type') == config ('orders-status.unfulfilled') ? 'text-indigo border-indigo' : '' }}"
                href="{{ route('users.orders.index', [app()->getLocale(), auth()->user ()]) . '/?type=' . config
                ('orders-status.unfulfilled') }}"
        >
            {{ __ ('Unfulfilled') }}
        </a>

        <a
                class="ml-8 pb-4 text-grey-dark font-bold border-b border-transparent {{ request('type') == config
                ('orders-status.pending') ?
                'text-indigo
                border-indigo' : '' }}"
                href="{{ route('users.orders.index', [app()->getLocale(), auth()->user ()]) . '/?type=' . config
                ('orders-status.pending') }}"
        >
            {{ __ ('Pending') }}
        </a>

        <a
                class="ml-8 pb-4 text-grey-dark font-bold border-b border-transparent {{ request('type') ==
                config('orders-status.fulfilled') ?
                'text-indigo border-indigo'
                : ''
                 }}"
                href="{{ route('users.orders.index', [app()->getLocale(), auth() ->user() ]) . '/?type=' . config
                ('orders-status.fulfilled') }}"
        >
            {{ __ ('Fulfilled') }}
        </a>
    </div>
</div>
