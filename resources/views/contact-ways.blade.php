<section class="md:px-0 pt-8 pt-24 py-24 flex flex-wrap items-center w-full relative z-10 contact-ways @if (app
    ()->getLocale() === 'fa') fa-contact-ways @endif bg-white">
    <div class="text-center md:w-1/2 relative @if (app()->getLocale() === 'fa') md:pr-32 @else pl-32
@endif">
        <img src="{{ asset('images/contact-home.svg') }}" alt="woman calling and finding location"
             data-sal="fade"
             data-sal-easing="ease-out-back"
             data-sal-delay="5000"
             class="w-2/3 md:w-full mb-8 md:mb-0" style="transform: rotateY(180deg); @if (app()->getLocale() ===
                 'en')
                transform: rotateY(0deg); @endif">
    </div>

    <div class="md:w-1/2 md:pr-32 mx-auto md:pt-0 relative z-10 items-start
                    flex flex-col justify-center @if (app()->getLocale() === 'fa') md:pr-32 @else md:pl-32 @endif">
        <h3 class="text-grey-900 font-light pb-3 text-2xl"
            data-sal="slide-right"
            data-sal-delay="300"
            data-sal-duration="600">
            {{ $home ? $home->data[app()->getLocale()]['ConnectionTitle'] : '' }}
        </h3>

        <span class="block h-1 w-12 bg-red mb-8"
              data-sal="slide-right"
              data-sal-delay="400"
              data-sal-duration="600"></span>

        <ul class="relative z-10 list-reset mb-8 text-red text-sm md:text-normal"
            data-sal="zoom"
            data-sal-delay="500"
            data-sal-duration="600">
            <li class="py-3 flex items-center">
                <i class="las la-phone-volume text-2xl"></i>
                <span class="text-grey-darker @if (app()->getLocale() === 'fa') mr-2 @else ml-2 @endif">
                        {{ $home ? $home->data[app()->getLocale()]['ConnectionPhone'] : '' }}
                    </span>
            </li>

            <li class="py-3 flex items-center">
                <i class="las la-mobile text-2xl"></i>
                <span class="text-grey-darker @if (app()->getLocale() === 'fa') mr-2 @else ml-2 @endif">
                        {{ $home ?  $home->data[app()->getLocale()]['ConnectionMobile'] : '' }}
                    </span>
            </li>

            <li class="py-3 flex items-center">
                <i class="lab la-instagram text-2xl"></i>
                <span class="text-grey-darker @if (app()->getLocale() === 'fa') mr-2 @else ml-2 @endif">
                        {{  $home ? $home->data[app()->getLocale()]['ConnectionInsta'] : '' }}
                    </span>
            </li>

            <li class="py-3 flex items-center">
                <i class="lab la-whatsapp text-2xl"></i>
                <span class="text-grey-darker @if (app()->getLocale() === 'fa') mr-2 @else ml-2 @endif">
                        {{ $home ? $home->data[app()->getLocale()]['ConnectionWhatsApp'] : '' }}
                    </span>
            </li>

            <li class="py-3 flex items-center">
                <i class="las la-envelope-open-text text-2xl"></i>
                <span class="text-grey-darker @if (app()->getLocale() === 'fa') mr-2 @else ml-2 @endif">
                        {{ $home ? $home->data[app()->getLocale()]['ConnectionEmail'] : '' }}
                    </span>
            </li>
        </ul>

        <a href="{{ route('contact', app()->getLocale()) }}" class="inline-flex items-center text-red border border-red
            px-8 py-3
            rounded-full
                        hover:bg-red hover:text-white tex"
           data-sal="flip-up"
           data-sal-delay="600"
           data-sal-duration="600"
        >
            {{ __('contact') }}
            @if (app()->getLocale() === 'fa')
                <i class="la la-long-arrow-alt-left text-lg mr-2"></i>
            @else
                <i class="la la-long-arrow-alt-right text-lg ml-2"></i>
            @endif
        </a>
    </div>
</section>
