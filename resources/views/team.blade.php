<section id="team" class="pt-12 pb-12 md:pb-0 px-8 md:px-24 bg-grey-lightest">
    <div class="md:pb-24 bg-contain bg-no-repeat bg-center"
         style="background-image: url({{ asset ('images/map.png.svg') }});">
        <h3 class="text-grey-900 font-light pb-3 text-2xl mb-12"
            data-sal="slide-left"
            data-sal-duration="600"
            data-sal-delay="600"
        >
            {{ __('Professional Team') }}
            <span class="block mt-4 h-1 w-24 bg-red mb-8"
                  data-sal="slide-left"
                  data-sal-delay="300"
                  data-sal-duration="600"></span>
        </h3>

        <div class="bg-white rounded-lg p-12 md:w-1/2 mx-auto shadow relative"
             data-sal="fade"
             data-sal-duration="400"
             data-sal-delay="800">
            <img class="w-24 h-24 rounded-full absolute"
                 style="left: 50%; top: 0; transform: translate(-50%, -50%);"
                 src="{{ $authorAvatar  }}"
                 alt="Author Avatar">

            <div class="text-center p-4">
                <h3 class="text-indigo mb-2">{{ __('Lamiah Hashemi') }}</h3>

                <p class="mb-2">
                    {{ $home ? $home->data[app()->getLocale()]['TeamTitle'] : '' }}
                </p>

                <blockquote class="text-grey-dark leading-normal">
                    <p class="relative text-sm">
                        <span class="text-indigo text-3xl absolute pin-r pin-t" style="top: -20px;">"</span>
                        {{ $home ? $home->data[app()->getLocale()]['TeamBody'] : '' }}
                        <span class="text-indigo text-3xl absolute pin-l pin-b" style="bottom: -20px;">"</span>
                    </p>
                </blockquote>
            </div>
        </div>
    </div>
</section>
