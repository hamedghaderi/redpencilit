<section class="services pt-0 md:pt-24 pb-4 bg-white">
    <div class="px-8 md:px-24">
        <div class="flex items-start mb-8">
            <div class="lg:w-1/2 mb-12 md:mb-0 mt-8">
                <h3 class="text-grey-900 font-light pb-3 text-normal lg:text-3xl"
                    data-sal="slide-right"
                    data-sal-delay="300"
                    data-sal-easing="ease-out-back"
                    data-sal-duration="400">
                    {{ $home ? $home->data[app()->getLocale()]['ServicesTitle'] : '' }}
                </h3>

                <span class="block h-1 w-12 bg-red mb-3"></span>

                <p class="text-grey-dark leading-loose text-sm lg:text-lg mb-4"
                   data-sal="slide-left"
                   data-sal-delay="300"
                   data-sal-easing="ease-out-back"
                   data-sal-duration="400">
                    {{ $home ? $home->data[app()->getLocale()]['ServicesBody'] : '' }}
                </p>
            </div>
        </div>

        <div class="flex flex-wrap mb-24 -mx-8">
            <div class="lg:w-1/3 px-8 mb-24 md:mb-0" data-sal="slide-up" data-sal-delay="300"
                 data-sal-easing="ease-out-back"
                 data-sal-duration="400">
                <img src="{{ asset('images/service1.svg') }}"
                     alt="{{ $home ? $home->data[app()->getLocale()]['FirstServiceTitle'] : '' }}" class="mb-8">
                <h4 class="text-lg lg:text-2xl font-normal mb-4">
                    {{ $home ? $home->data[app()->getLocale()]['FirstServiceTitle'] : '' }}
                </h4>
                <p class="text-grey-dark leading-loose text-sm lg:text-normal">
                    {{ $home ? $home->data[app()->getLocale()]['FirstServiceBody'] : '' }}
                </p>
            </div>

            <div class="lg:w-1/3 px-8 md:-mt-8 mb-12 md:mb-0" data-sal="slide-up" data-sal-delay="400"
                 data-sal-easing="ease-out-back"
                 data-sal-duration="400">
                <img src="{{ asset('images/service2.svg') }}"
                     alt="{{ $home ? $home->data[app()->getLocale()]['SecondServiceTitle'] : '' }}" class="mb-8">
                <h4 class="text-lg lg:text-2xl font-normal mb-4">
                    {{ $home ? $home->data[app()->getLocale()]['SecondServiceTitle'] : '' }}
                </h4>
                <p class="text-grey-dark leading-loose text-sm lg:text-normal">
                    {{ $home ? $home->data[app()->getLocale()]['SecondServiceBody'] : '' }}
                </p>
            </div>

            <div class="lg:w-1/3 px-8 md:-mt-24" data-sal="slide-up" data-sal-delay="500"
                 data-sal-easing="ease-out-back"
                 data-sal-duration="400">
                <img src="{{ asset('images/service3.svg') }}"
                     alt="{{ $home ? $home->data[app()->getLocale()]['ThirdServiceTitle'] : '' }}" class="mb-8">
                <h4 class="text-lg lg:text-2xl font-normal mb-4">
                    {{ $home ? $home->data[app()->getLocale()]['ThirdServiceTitle'] : '' }}
                </h4>
                <p class="text-grey-dark leading-loose text-sm lg:text-normal">
                    {{ $home ? $home->data[app()->getLocale()]['ThirdServiceBody'] : '' }}
                </p>
            </div>
        </div>
    </div>
</section>
