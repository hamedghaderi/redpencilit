<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RedPencilIt') }}</title>

        <link rel="stylesheet" href="{{ asset('css/vendor/all.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <script>
            window.Redpencilit = {!!
            json_encode([
                'signed' => Auth::check(),
                'user' => Auth::user()
            ]);
         !!}
        </script>
    </head>
    <body class="bg-white">
        <div id="app" class="relative overflow-hidden">
            <img class="absolute w-4/5 z-0"
                 style="left: -300px; top:-150px;"
                 src="{{ asset('images/hero_home.png') }}"
                 alt="A woman working with her laptop">

            <div class="container pt-8 mb-32">
                <div class="flex items-center">
                    <a href="/">
                        <img src="{{ asset('/images/logo.svg') }}" alt="red pencil it">
                    </a>

                    <ul class="flex list-reset mr-8">
                        <li><a href="/" class="text-red">خانه</a></li>
                        <li><a href="/about" class="text-grey-dark mr-6">درباره</a></li>
                        <li><a href="/contact" class="text-grey-dark mr-6">تماس با ما</a></li>
                        <li><a href="/services" class="text-grey-dark mr-6">خدمات</a></li>
                        <li><a href="/orders/create" class="text-grey-dark mr-6">ثبت سفارش</a></li>
                    </ul>

                    <nav-dropdown class="mr-auto" button="white"></nav-dropdown>
                </div>
            </div>


            <div class="container mb-24">
                <div class="w-1/3">
                    <h1 class="mb-4">عنوان</h1>
                    <p class="leading-loose text-grey-dark">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                        و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه
                        و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی
                        مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>
                </div>
            </div>


            <section class="services mb-24">
                <div class="container">
                    <div class="flex items-center">
                        <div class="w-1/4">
                            <h3 class="title">خدمات</h3>
                            <p class="text-grey-dark leading-loose text-sm mb-4">لورم ایپسوم متن ساختگی با تولید سادگی
                                نامفهوم از
                                صنعت چاپ
                                و با استفاده از طراحان گرافیک است. </p>

                            <a href="/services" class=" button button--outline button--outline--danger button--sm
                            rounded-full has-icon">
                                توضیح بیشتر
                                <i class="text-danger fas fa-arrow-left"></i>
                            </a>
                        </div>

                        <div class="w-2/4 mr-auto">
                           <div class="flex">
                               <div class="w-1/3 text-center px-6">
                                   <img class="mb-3" src="{{ asset('images/first-service.svg') }}" alt="first service">
                                   <span class="text-center text-grey-dark">سرویس اول</span>
                               </div>

                               <div class="w-1/3 text-center px-6">
                                   <img class="mb-3" src="{{ asset('images/second-service.svg') }}" alt="second
                                   service">
                                   <span class="text-center text-orange-light">سرویس دوم</span>
                               </div>

                               <div class="w-1/3 text-center px-6">
                                   <img class="mb-3" src="{{ asset('images/third-service.svg') }}" alt="third service">
                                   <span class="text-center text-indigo">سرویس سوم</span>
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="contact-ways relative" style="min-height: 600px;">
                <div class="container">
                    <img src="{{ asset('images/hom-connection.png') }}" alt="home-connection" class="home-connection">
                </div>
            </section>
        </div>


        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
