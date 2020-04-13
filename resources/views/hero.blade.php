<div class="pb-12 md:pb-24 px-8 md:px-24 flex">
    <div class="md:w-1/2 pb-12 md:pb-0">
        <h1 class="mb-2 md:mb-4 text-xl lg:text-3xl xl:text-5xl"
            data-sal="slide-right"
            data-sal-delay="300"
            data-sal-easing="ease-out-back"
            data-sal-duration="400">
            {{ $home ? $home->data[app()->getLocale()]['HomeHeroTitle'] : '' }}
        </h1>
        <p class="text-sm lg:text-lg leading-loose text-grey-dark mb-6"
           data-sal="slide-left"
           data-sal-delay="300"
           data-sal-easing="ease-out-back"
           data-sal-duration="400"
        >
            {{ $home ? $home->data[app()->getLocale()]['HomeHeroBody'] : '' }}
        </p>

        <a href="{{ route('new-order', app()->getLocale()) }}"
           class="inline-flex items-center text-sm text-white md:text-normal bg-red  border border-red px-8
                           py-3 rounded-full shadow-button hover:shadow-none"
           data-sal="zoom-in"
           data-sal-delay="400"
           data-sal-duration="400"
        >
            {{ $home ? $home->data[app()->getLocale()]['HomeHeroButton'] : '' }}
            @if (app()->getLocale() === 'fa')
                <i class="la la-long-arrow-alt-left text-lg mr-2"></i>
            @else
                <i class="la la-long-arrow-alt-right text-lg ml-2"></i>
            @endif
        </a>
    </div>
</div>
