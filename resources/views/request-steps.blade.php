<section id="order-steps" class="bg-white md:bg-white py-24 md:px-24 relative pb-12">
    <img src="{{ asset('images/leaf.svg') }}" alt="leaf" class="absolute pin-t hidden md:block"
         style="height: 600px; left: -40%; transform: translateX(50%)">

    <div class="flex flex-col items-center">
        <h3 class="text-grey-900 font-light pb-3 text-normal md:text-2xl">
            {{ $home ? $home->data[app()->getLocale()]['RequestTitle'] : '' }}
            <span class="block mt-4 h-1 w-24 bg-red mb-8"></span>
        </h3>

        <p class="text-center w-2/3 text-grey-dark leading-loose text-sm">
            {{ $home ? $home->data[app()->getLocale()]['RequestBody'] : '' }}
        </p>

        <img src="@if (app()->getLocale() === 'fa') {{ asset('images/fa-steps.png') }} @else {{ asset ('images/en-steps.png') }} @endif"
             alt="chart of upload steps"
             class="md:w-2/3 mb-8"
             data-sal="slide-down"
             data-sal-duration="1000"
             data-sal-delay="600"
        >
    </div>
</section>
