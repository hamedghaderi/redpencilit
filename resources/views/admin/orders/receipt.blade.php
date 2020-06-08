<div class="bg-red-lightest rounded-t-lg p-8 pb-0 shadow relative">
    <div class="flex items-center pb-8">
        <div class="flex items-center justify-center bg-red rounded-full w-12 h-12">
            <i class="la la-file-invoice-dollar text-2xl text-white"></i>
        </div>

        <div class="@if (app()->getLocale() === 'fa') mr-4 @else ml-4 @endif">
            <p class="text-grey-dark mb-2">{{ $order->created_at->toDateString() }}</p>
            <h2 class="text-red text-3xl text-base font-normal">
                {{ __('Invoice') }} @if (app()->getLocale() === 'en') # @endif {{ $order->id  }}
                @if(app()->getLocale() === 'fa') # @endif
            </h2>
        </div>
    </div>

    <div class="bg-red text-white lg:w-1/2 w-full mx-auto p-8 relative shadow-lg"
         style="top: 20px;">
        <p class="mb-2">{{ __('Total Pay') }}</p>
        <div class="lg:text-4xl text-3xl">{{ $order->price }} {{ __('tomans') }} </div>
    </div>
</div>
