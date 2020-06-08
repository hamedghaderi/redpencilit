<div class="bg-white rounded shadow pt-16 pb-12 p-8">
    <div class="pb-4 mb-8 border-b border-gray-100 text-xs font-bold text-grey-dark">
        {{ __('Details') }}
    </div>

    <div class="mb-8 flex">
        @foreach($order->details as $detail)
            <a class="flex lg:w-1/3 w-full items-center text-grey-darkest hover:text-red"
               href="{{ route('orders.attachment', [app()->getLocale(), $order, $detail])  }}">
                <div class="bg-red-lightest w-16 h-16 flex items-center justify-center"
                     href="{{ route('orders.attachment', [app()->getLocale(), $order, $detail]) }}">
                    <i class="la la-box text-4xl text-red"></i>
                </div>

                <p class="inline-flex @if (app()->getLocale() === 'fa') mr-4 @else ml-4 @endif">
                    {{ pathinfo($detail->name, PATHINFO_FILENAME) }}
                </p>
            </a>
        @endforeach
    </div>

    <hr>

    <dl class="flex flex-wrap mb-8 text-sm">
        <dt class="w-1/2 text-grey-dark mb-6">{{ __('Uploaded by') }}</dt>
        <dd class="w-1/2 mb-6">
            <span class="bg-pink-lightest inline-flex items-center justify-center w-8 h-8
            rounded-full">
                <i class="la la-user text-pink"></i>
            </span>
            <span class="mr-2">{{ $order->owner->name }}</span>
        </dd>

        <dt class="w-1/2 text-grey-dark mb-6">{{ __('File name') }}</dt>
        <dd class="w-1/2 mb-6 flex items-center">
            @foreach($order->details as $details)
                <div>
                <span class="bg-pink inline-block w-3 h-3 rounded-full @if (app()->getLocale()
                === 'fa') ml-2 @else mr-2 @endif"></span>
                    {{ pathinfo($details->name, PATHINFO_FILENAME) }}
                    <span class="text-grey-dark mr-1">({{ $detail->words . ' ' . __ ('word') }})</span>
                    @endforeach
                </div>
        </dd>

        <dt class="w-1/2 text-grey-dark mb-6">{{ __('Status') }}</dt>
        <dt class="w-1/2 mb-6 flex items-center">
            @if ($order->payed)
                {{ __('Paid') }}
            @else
                {{ __('Draft') }}
            @endif
        </dt>

        <dt class="w-1/2 text-grey-dark mb-6">{{ __('Quantity') }}</dt>
        <dt class="w-1/2 mb-6 flex items-center">
            {{ $order->orders_count }} {{ __('file') }}
        </dt>
    </dl>

{{--    <hr>--}}

{{--    <div class="flex text-sm w-full items-center mb-12">--}}
{{--        <div class="flex items-center">--}}
{{--            {{ __('Change Progress') }}:--}}
{{--            <select-tag class="@if (app()->getLocale() === 'fa') mr-2 @else ml-2 @endif"--}}
{{--                        :status="{{ $order->status }}"--}}
{{--                        order_id="{{ $order->id--}}
{{--            }}"></select-tag>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <hr>--}}

{{--    <form action="{{ route('upload-completed-orders', [app()->getLocale(), $order]) }}"--}}
{{--          method="POST"--}}
{{--          enctype="multipart/form-data"--}}
{{--          class="flex items-center"--}}
{{--    >--}}
{{--        @csrf--}}
{{--        <div class="mb-8">--}}
{{--            <label for="upload" class="label mb-4">{{ __('Upload Final Articles') }}</label>--}}
{{--            <input type="file" multiple name="attachments[]">--}}
{{--        </div>--}}
{{--        <button class="button button--primary ml-auto">{{ __('Upload') }}</button>--}}
{{--    </form>--}}
</div>
