@extends('layouts.home')

@section('content')
    <section class="relative bg-contain bg-no-repeat home-hero" id="intro">
        <img src="{{ asset('images/1.svg') }}" alt="a girl with a computer" class="home-hero-bg @if (app()->getLocale
        () === 'en') en-home-hero-bg @endif">

        <div class="px-8 md:px-24 pt-8 md:pb-0">
            @include('partials.nav-home')
        </div>

        {{--==========================================================
        |  Hero
        ============================================================--}}
        <div class="pb-12 md:pb-24 px-8 md:px-24 flex">
            <div class="md:w-1/2 pb-12 md:pb-0">
                <h1 class="mb-2 md:mb-4 text-xl lg:text-3xl xl:text-5xl"
                    data-sal="slide-right"
                    data-sal-delay="300"
                    data-sal-easing="ease-out-back"
                    data-sal-duration="400">
                    {{ $home->data[app()->getLocale()]['HomeHeroTitle'] }}
                </h1>
                <p class="text-sm lg:text-lg leading-loose text-grey-dark mb-6"
                   data-sal="slide-left"
                   data-sal-delay="300"
                   data-sal-easing="ease-out-back"
                   data-sal-duration="400"
                >
                    {{ $home->data[app()->getLocale()]['HomeHeroBody'] }}
                </p>

                <a href="{{ route('new-order', app()->getLocale()) }}"
                   class="inline-flex items-center text-sm md:text-normal bg-red text-white border border-red px-8
                           py-3 rounded-full hover:bg-red hover:text-white"
                   data-sal="zoom-in"
                   data-sal-delay="400"
                   data-sal-duration="400"
                >
                    {{ $home->data[app()->getLocale()]['HomeHeroButton'] }}
                    @if (app()->getLocale() === 'fa')
                        <i class="la la-long-arrow-alt-left text-lg mr-2"></i>
                    @else
                        <i class="la la-long-arrow-alt-right text-lg ml-2"></i>
                    @endif
                </a>
            </div>
        </div>
    </section>


    {{--==========================================================
    | Services
    ============================================================--}}
    <section class="services pt-0 md:pt-24 pb-16 bg-white">
        <div class="px-8 md:px-24">
            <div class="flex flex-wrap items-start">
                <div class="lg:w-1/2 mb-12 md:mb-0 mt-8">
                    <h3 class="text-grey-900 font-light pb-3 text-normal lg:text-3xl"
                        data-sal="slide-right"
                        data-sal-delay="300"
                        data-sal-easing="ease-out-back"
                        data-sal-duration="400">
                        {{ $home->data[app()->getLocale()]['ServicesTitle'] }}
                    </h3>

                    <span class="block h-1 w-12 bg-red mb-3"></span>

                    <p class="text-grey-dark leading-loose text-sm mb-4"
                       data-sal="slide-left"
                       data-sal-delay="300"
                       data-sal-easing="ease-out-back"
                       data-sal-duration="400"
                    >
                        {{ $home->data[app()->getLocale()]['ServicesBody'] }}
                    </p>
                </div>

                <div class="lg:w-1/2 flex @if (app()->getLocale() === 'fa') mr-auto @else ml-auto @endif">
                    <div class="bg-white shadow-lg rounded-lg relative mt-24 service-card @if (app()->getLocale() ===
                     'fa') mr-auto @else ml-auto @endif">
                        <img src="{{ asset('images/3.svg') }}" alt="a guy vector" class="absolute z-0" style="top:
                       -50%; left: 50%; transform: translate(-50%, -50%);">
                        <div class="pt-32 pb-8 lg:pb-32 px-8">
                            <h4 class="text-lg lg:text-2xl font-normal mb-4 lg:mb-8">
                                {{ $home->data[app()->getLocale()]['FirstServiceTitle'] }}
                            </h4>
                            <p class="text-grey-dark leading-loose text-sm lg:text-lg mb-4 lg:mb-12">
                                {{ $home->data[app()->getLocale()]['FirstServiceBody'] }}
                            </p>
                            <a class="text-red underline" href="{{ route('pages.services', app()->getLocale()) }}">
                                {{ __('learn more') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2 flex lg:pr-24 -mt-300">
                    <div class="bg-white shadow-lg rounded-lg relative mt-24 service-card">
                        <img src="{{ asset('images/4.svg') }}" alt="a guy vector" class="absolute z-0" style="top:
                       -50%; left: 50%; transform: translate(-50%, -50%);">
                        <div class="pt-32 pb-8 lg:pb-32 px-8">
                            <h4 class="text-lg lg:text-2xl font-normal mb-4 lg:mb-8">
                                {{ $home->data[app()->getLocale()]['SecondServiceTitle'] }}
                            </h4>
                            <p class="text-grey-dark leading-loose text-sm lg:text-lg mb-4 lg:mb-12">
                                {{ $home->data[app()->getLocale()]['SecondServiceBody'] }}
                            </p>
                            <a class="text-red underline" href="{{ route('pages.services', app()->getLocale()) }}">
                                {{ __('learn more') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="lg:w-2/4 flex mt-8 @if (app()->getLocale() === 'fa') mr-auto @else ml-auto @endif">
                    <div class="bg-white shadow-lg rounded-lg relative mt-24 service-card @if (app()->getLocale() ===
                     'fa') mr-auto @else ml-auto @endif">
                        <img src="{{ asset('images/5.svg') }}" alt="a guy vector" class="absolute z-0" style="top:
                       -50%; left: 50%; transform: translate(-50%, -50%);">
                        <div class="pt-32 pb-8 lg:pb-32 px-8">
                            <h4 class="text-lg lg:text-2xl font-normal mb-4 lg:mb-8">
                                {{ $home->data[app()->getLocale()]['ThirdServiceTitle'] }}
                            </h4>
                            <p class="text-sm lg:text-lg text-grey-dark leading-loose mb-4 lg:mb-12">
                                {{ $home->data[app()->getLocale()]['ThirdServiceBody'] }}
                            </p>
                            <a class="text-red underline" href="{{ route('pages.services', app()->getLocale()) }}">
                                {{ __('learn more') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{--==========================================================
    |  Contact Ways
    ============================================================--}}
    <section class="md:px-0 pt-8 md:pt-24 py-12 flex flex-wrap items-center w-full relative z-10 contact-ways @if (app
    ()->getLocale() === 'en') en-contact-ways @endif bg-white">
        <div class="md:w-1/2 relative pidgin @if (app()->getLocale() === 'fa') pr-32 @else pl-32 @endif">
            <img src="{{ asset('images/6.svg') }}" alt="a woman on a pidgin"
                 data-sal="slide-left"
                 data-sal-duration="400"
                 class="w-1/2 md:w-full" style="transform: rotateY(180deg); @if (app()->getLocale() === 'en')
                    transform: rotateY(0deg); @endif">
        </div>

        <div class="md:w-1/2 md:pr-32 mx-auto md:pt-0 relative z-10 items-start
                    flex flex-col justify-center @if (app()->getLocale() === 'fa') md:pr-32 @else md:pl-32 @endif">
            <h3 class="text-grey-900 font-light pb-3 text-2xl"
                data-sal="slide-right"
                data-sal-delay="300"
                data-sal-duration="600">
                {{ $home->data[app()->getLocale()]['ConnectionTitle'] }}
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
                        {{ $home->data[app()->getLocale()]['ConnectionPhone'] }}
                    </span>
                </li>

                <li class="py-3 flex items-center">
                    <i class="las la-mobile text-2xl"></i>
                    <span class="text-grey-darker @if (app()->getLocale() === 'fa') mr-2 @else ml-2 @endif">
                        {{ $home->data[app()->getLocale()]['ConnectionMobile'] }}
                    </span>
                </li>

                <li class="py-3 flex items-center">
                    <i class="lab la-instagram text-2xl"></i>
                    <span class="text-grey-darker @if (app()->getLocale() === 'fa') mr-2 @else ml-2 @endif">
                        {{ $home->data[app()->getLocale()]['ConnectionInsta'] }}
                    </span>
                </li>

                <li class="py-3 flex items-center">
                    <i class="lab la-whatsapp text-2xl"></i>
                    <span class="text-grey-darker @if (app()->getLocale() === 'fa') mr-2 @else ml-2 @endif">
                        {{ $home->data[app()->getLocale()]['ConnectionWhatsApp'] }}
                    </span>
                </li>

                <li class="py-3 flex items-center">
                    <i class="las la-envelope-open-text text-2xl"></i>
                    <span class="text-grey-darker @if (app()->getLocale() === 'fa') mr-2 @else ml-2 @endif">
                        {{ $home->data[app()->getLocale()]['ConnectionEmail'] }}
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

    {{--==========================================================
     |  Request Steps
     ============================================================--}}
    <section id="order-steps" class="bg-white md:bg-white py-12 md:px-24 relative pb-12">
        <img src="{{ asset('images/leaf.svg') }}" alt="leaf" class="absolute pin-t hidden md:block"
             style="height: 600px; left: -40%; transform: translateX(50%)">

        <div class="flex flex-col items-center">
            <h3 class="text-grey-900 font-light pb-3 text-normal md:text-2xl">
                {{ $home->data[app()->getLocale()]['RequestTitle'] }}
                <span class="block mt-4 h-1 w-24 bg-red mb-8"></span>
            </h3>

            <p class="text-center w-2/3 text-grey-dark leading-loose text-sm">
                {{ $home->data[app()->getLocale()]['RequestBody'] }}
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


    {{--==========================================================
      | Testimonials
      ============================================================--}}
    <section id="your-comments" class="z-10 bg-cover relative overflow-hidden px-8 md:px-24 md:flex"
             style="background-image: url({{ asset('images/coffee.svg.jpg') }}); min-height: 450px;">

        <img src="{{ asset('images/coffee-blur.jpg.svg') }}" alt="a white blur shape"
             class="w-1/2 absolute z-0 {{ app()->getLocale() === 'fa' ? 'cloud-right' : 'cloud-left' }}"
             style="top: -180px; transform:rotate(-15deg);">

        <div class="pt-24 relative z-10 md:mb-8">
            <h3 class="text-white md:text-grey-900 font-light pb-3 text-2xl"
                data-sal="slide-left"
                data-sal-duration="600"
                data-sal-delay="600">

                {{ $home->data[app()->getLocale()]['Testimonial'] }}
                <span class="block mt-4 h-1 w-24 bg-red mb-8"
                      data-sal="slide-left"
                      data-sal-delay="1000"
                      data-sal-duration="600"></span>
            </h3>
        </div>

        <div class="@if (app()->getLocale() === 'fa') mr-auto @else ml-auto @endif w-full md:w-1/2 carousel flex
        flex-col md:justify-center"
             style="height: 500px;
        max-height:
        500px;
        overflow: hidden">
            @foreach($testimonials as $testimonial)
                <div class="bg-white hover:shadow-2xl rounded shadow-lg mb-4 px-8 py-4 carousel__item">
                    <div class="flex border-b border-grey-lighter pb-4 mb-6 w-full">
                        <h4 class="text-grey-darkest">{{ $testimonial->comment->name }}</h4>
                        <span class="text-grey mr-auto text-sm">
                            {{ $testimonial->comment->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <p class="text-sm text-grey-dark w-full mb-1">
                        <span class="text-indigo text-lg font-bold">"</span>
                        {{ $testimonial->body }}
                        <span class="text-indigo text-lg font-bold">"</span>
                    </p>

                    <div class="w-full">
                        <ul class="flex list-reset justify-end">
                            @for($i = 0; $i < 5; $i++)
                                <li class="text-yellow-dark mr-1">
                                    <i class="fa-star {{ $testimonial->comment->rate > $i ? 'fas' : 'far' }}"></i>
                                </li>
                            @endfor
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{--==========================================================
     | Team
     ============================================================--}}
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
                        {{ $home->data[app()->getLocale()]['TeamTitle'] }}
                    </p>

                    <blockquote class="text-grey-dark leading-normal">
                        <p class="relative text-sm">
                            <span class="text-indigo text-3xl absolute pin-r pin-t" style="top: -20px;">"</span>
                            {{ $home->data[app()->getLocale()]['TeamBody'] }}
                            <span class="text-indigo text-3xl absolute pin-l pin-b" style="bottom: -20px;">"</span>
                        </p>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        const scrollAnimation = window.sal();

        scrollAnimation.enable();
    </script>
@endsection
