@extends('layouts.home')

@section('content')
    <section class="bg-white relative bg-contain bg-no-repeat home-hero" id="intro">
        <div class="px-8 md:px-24 pt-8 md:pb-0">
            @include('partials.nav-home')
        </div>

        {{--==========================================================
        |  Hero
        ============================================================--}}
        <div class="pb-12 md:pb-24 px-8 md:px-24">
            <div class="md:w-1/3 border-b md:border-none pb-12 md:pb-0">
                <h1 class="mb-2 md:mb-4">عنوان</h1>
                <p class="text-sm md:text-normal leading-loose text-grey-dark mb-6">لورم ایپسوم متن ساختگی با تولید
                    سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه
                    و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی
                    مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>

                <a href="/about"
                   class="inline-flex items-center text-sm md:text-normal text-red border border-red px-8
                           py-3 rounded-full hover:bg-red hover:text-white">
                    درباره ما
                    <svg class="fill-current h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         width="24"
                         height="24">
                        <path class="heroicon-ui"
                                d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>


    {{--==========================================================
    | Services
    ============================================================--}}
    <section class="services pb-12 md:pb-24 bg-white">
        <div class="px-8 md:px-24">
            <div class="flex flex-wrap items-center">
                <div class="md:w-1/4 mb-12 md:mb-0">
                    <h3 class="text-grey-900 font-light pb-3 text-2xl">
                        خدمات
                    </h3>

                    <span class="block h-1 w-12 bg-red mb-3"></span>

                    <p class="text-grey-dark leading-loose text-sm mb-4">لورم ایپسوم متن ساختگی با تولید سادگی
                        نامفهوم از
                        صنعت چاپ
                        و با استفاده از طراحان گرافیک است. </p>

                    <a href="/services"
                       class="inline-flex items-center text-sm md:text-normal text-red border border-red
                            px-8 py-3 rounded-full hover:bg-red hover:text-white tex">
                        توضیح بیشتر
                        <svg class="fill-current h-4 w-4 mr-2"
                             xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 24 24"
                             width="24"
                             height="24">
                            <path class="heroicon-ui"
                                d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"/>
                        </svg>
                    </a>
                </div>

                <div class="md:w-2/4 mr-auto">
                    <div class="flex">
                        <div class="w-1/3 text-center px-6">
                            <img class="mb-0 md:mb-3" src="{{ asset('images/first-service.svg') }}" alt="first service">
                            <span class="text-center text-grey-dark text-sm md:text-noraml">سرویس اول</span>
                        </div>

                        <div class="w-1/3 text-center px-6">
                            <img class="mb-0 md:mb-3" src="{{ asset('images/second-service.svg') }}" alt="second
                                   service">
                            <span class="text-center text-orange-light text-sm md:text-noraml">سرویس دوم</span>
                        </div>

                        <div class="w-1/3 text-center px-6">
                            <img class="mb-0 md:mb-3" src="{{ asset('images/third-service.svg') }}" alt="third service">
                            <span class="text-center text-indigo text-sm md:text-noraml">سرویس سوم</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{--==========================================================
    |  Contact Ways
    ============================================================--}}
    <section class="md:px-0 pb-12 flex relative bg-left-top w-full home-contact">
        <img src="{{ asset('images/connection-home-bg.svg') }}" alt="background" class="home-contact-bg">

        <div class="md:w-1/2 relative overflow-hidden home-contact-img-wrapper">
            <img src="{{ asset('images/hom-connection.png') }}" alt="home-contact" class="home-contact-img">
        </div>

        <div class="md:w-1/2 md:pr-32 mt-12 md:mt-32 mx-auto md:pt-0 relative z-10 items-start
                    flex flex-col justify-center">
            <h3 class="text-grey-900 font-light pb-3 text-2xl">
                راه های ارتباطی ما
            </h3>

            <span class="block h-1 w-12 bg-red mb-8"></span>

            <ul class="relative z-10 list-reset mb-8 text-red text-sm md:text-normal">
                <li class="py-3 flex items-center">
                    <svg class="fill-current w-5 h-5"
                         xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         width="24"
                         height="24">
                        <path class="heroicon-ui"
                            d="M13.04 14.69l1.07-2.14a1 1 0 0 1 1.2-.5l6 2A1 1 0 0 1 22 15v5a2 2 0 0 1-2 2h-2A16 16 0 0 1 2 6V4c0-1.1.9-2 2-2h5a1 1 0 0 1 .95.68l2 6a1 1 0 0 1-.5 1.21L9.3 10.96a10.05 10.05 0 0 0 3.73 3.73zM8.28 4H4v2a14 14 0 0 0 14 14h2v-4.28l-4.5-1.5-1.12 2.26a1 1 0 0 1-1.3.46 12.04 12.04 0 0 1-6.02-6.01 1 1 0 0 1 .46-1.3l2.26-1.14L8.28 4zm12.01-1.7a1 1 0 0 1 1.42 1.4L17.4 8H20a1 1 0 0 1 0 2h-5a1 1 0 0 1-1-1V4a1 1 0 0 1 2 0v2.59l4.3-4.3z"/>
                    </svg>
                    <span class="text-grey-darker mr-2">988733776522+</span>
                </li>

                <li class="py-3 flex items-center">
                    <svg class="fill-current w-5 h-5"
                         xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         width="24"
                         height="24">
                        <path class="heroicon-ui"
                            d="M8 2h8a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2zm0 2v16h8V4H8zm4 14a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </svg>
                    <span class="text-grey-darker mr-2">989188736585+</span>
                </li>

                <li class="py-3 flex items-center">
                    <svg class="fill-current w-5 h-5"
                         xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         width="24"
                         height="24">
                        <path class="heroicon-ui"
                            d="M18 18v2a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-2H4a2 2 0 0 1-2-2v-6c0-1.1.9-2 2-2h2V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v4h2a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2h-2zm0-2h2v-6H4v6h2v-2c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v2zm-2-8V4H8v4h8zm-8 6v6h8v-6H8z"/>
                    </svg>
                    <span class="text-grey-darker mr-2">988733776520+</span>
                </li>

                <li class="py-3 flex items-center">
                    <svg class="fill-current w-5 h-5"
                         xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         width="24"
                         height="24">
                        <path class="heroicon-ui"
                            d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"/>
                    </svg>
                    <span class="text-grey-darker mr-2">rojan.sharifi@gmail.com</span>
                </li>
            </ul>

            <a href="/services" class="inline-flex items-center text-red border border-red px-8 py-3 rounded-full
                        hover:bg-red hover:text-white tex">
                ثبت نظرات
                <svg class="fill-current h-4 w-4 mr-2"
                     xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24"
                     width="24"
                     height="24">
                    <path class="heroicon-ui"
                        d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"/>
                </svg>
            </a>
        </div>
    </section>

    {{--==========================================================
     |  Request Steps
     ============================================================--}}
    <section id="order-steps" class="bg-white md:bg-white py-12 md:py-0 md:px-24 relative pb-12">
        <img src="{{ asset('images/leaf.svg') }}" alt="leaf" class="absolute pin-t hidden md:block"
             style="height: 600px; left: -40%; transform: translateX(50%)">

        <div class="flex flex-col items-center">
            <h3 class="text-grey-900 font-light pb-3 text-normal md:text-2xl">
                مراحل ثبت درخواست
                <span class="block mt-4 h-1 w-24 bg-red mb-8"></span>
            </h3>

            <p class="text-center w-2/3 text-grey-dark leading-loose text-sm">لورم ایپسوم متن ساختگی با تولید سادگی
                نامفهوم از صنعت
                چاپ و با
                استفاده از
                طراحان
                گرافیک است.
                چاپگرها و متون بلکه روزنامه
                و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی ورد نیاز و کاربردهای متنوع با هدف
                بهبود ابزارهای کاربردی می‌باشد.</p>

            <img src="{{ asset('images/steps.png.svg') }}" alt="chart of upload steps" class="md:w-2/3">
        </div>
    </section>

    <section id="your-comments" class="z-10 bg-cover relative overflow-hidden px-8 md:px-24 md:flex"
             style="background-image: url({{ asset('images/coffee.svg.jpg') }}); min-height: 450px;">

        <img src="{{ asset('images/coffee-blur.jpg.svg') }}" alt="a white blur shape"
             class="w-1/2 absolute z-0" style="right:-200px; top: -180px; transform:rotate(-15deg)">

        <div class="pt-24 relative z-10 md:mb-8">
            <h3 class="text-white md:text-grey-900 font-light pb-3 text-2xl">
                آنچه شما درباره ما گفته‌اید
                <span class="block mt-4 h-1 w-24 bg-red mb-8"></span>
            </h3>
        </div>

        <div class="mr-auto w-full md:w-1/2 carousel flex flex-col md:justify-center" style="height: 500px; max-height:
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

    <section id="team" class="pt-12 px-8 md:px-24 bg-grey-lightest">
        <div class="md:pb-24 bg-contain bg-no-repeat bg-center"
             style="background-image: url({{ asset ('images/map.png.svg') }});">
            <h3 class="text-grey-900 font-light pb-3 text-2xl mb-12">
                تیم حرفه‌ای
                <span class="block mt-4 h-1 w-24 bg-red mb-8"></span>
            </h3>

            <div class="bg-white rounded-lg p-12 md:w-1/2 mx-auto shadow relative">
                <img class="w-24 h-24 rounded-full absolute"
                     style="left: 50%; top: 0; transform: translate(-50%, -50%);"
                     src="{{ $authorAvatar ?: asset ('images/profile.png.jpg') }}"
                     alt="Author Avatar">

                <div class="text-center p-4">
                    <h3 class="text-indigo mb-2">لامعه هاشمی</h3>

                    <p class="mb-2">ویراستار و مدیر</p>

                    <blockquote class="text-grey-dark leading-normal">
                        <p class="relative text-sm">
                            <span class="text-indigo text-3xl absolute pin-r pin-t" style="top: -20px;">"</span>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                            و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه
                            و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی
                            مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                            <span class="text-indigo text-3xl absolute pin-l pin-b" style="bottom: -20px;">"</span>
                        </p>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>
@endsection