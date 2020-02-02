@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/vendor/tiny-slider.css') }}">
    <style>
        .tns-controls, .tns-nav, .tns-outer button, .tns-liveregion {
           display: none !important;
        }
        .container {
            max-width: 1200px !important;
            overflow: hidden !important;
        }
    </style>
@endsection

@section('content')
    <div class="px-8 md:px-32">
        <h2 class="title mb-12">{{ ucwords(__('services')) }}</h2>

        <div class="container" style="direction: ltr;">
            <div class="slider">
                <div>
                    <h2 class="text-grey-darkest text-xl md:text-3xl text-center mb-3">
                        {{ ucfirst(__('have a thesis expert improve your writing')) }}
                    </h2>
                    <p class="text-grey-dark leading-loose text-center mb-12">
                        {{ __('Hand in your thesis or dissertation with confidence. We can help you with our academic Proofreading & Editing service, Structure Check and Clarity Check. We improve your language mistakes directly and you’ll receive feedback to help you become a better writer.') }}</p>
                    <div class="text-center">
                        <img class="w-1/2" src="{{ asset('images/9.svg') }}" alt="image">
                    </div>
                </div>
                <div>
                    <h2 class="text-grey-darkest text-xl md:text-3xl text-center mb-3">
                        {{ ucfirst(__('Choose the best PhD dissertation editing service with Scribbr')) }}
                    </h2>
                    <p class="text-grey-dark leading-loose text-center mb-12">
                        {{ __('Hand in your thesis or dissertation with confidence. We can help you with our academic Proofreading & Editing service, Structure Check and Clarity Check. We improve your language mistakes directly and you’ll receive feedback to help you become a better writer.') }}
                    </p>
                    <div class="text-center">
                        <img class="w-1/2" src="{{ asset('images/10.svg') }}" alt="image">
                    </div>
                </div>
                <div>
                    <h2 class="text-grey-darkest text-xl md:text-3xl text-center mb-3">
                        {{ ucfirst(__('Essay Editing Service')) }}
                    </h2>
                    <p class="text-grey-dark leading-loose text-center mb-12">
                        {{ __('Hand in your thesis or dissertation with confidence. We can help you with our academic Proofreading & Editing service, Structure Check and Clarity Check. We improve your language mistakes directly and you’ll receive feedback to help you become a better writer.') }}
                    </p>
                    <div class="text-center">
                        <img class="w-1/2" src="{{ asset('images/11.svg') }}" alt="image">
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <!--[if (lt IE 9)]><script src="{{ asset('js/vendors/tiny-slider.helper.ie8.js') }}"></script><![endif]-->
    <script src="{{ asset('js/vendors/tiny-slider.js') }}"></script>
    <script>
        let slider = tns({
            container: '.slider',
            accessibility: false,
            centerMode: true,
            infinite: true,
            dots: true,
            slick: 500,
            autoplay: true,
            arrows: false,
            dots: true,
            // axis: "vertical",
            // rtl: true,

            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    infinite: true
                }
            }, {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    dots: true
                }

            }, {
                breakpoint: 300,
                settings: "unslick" // destroys slick
            }]
        });
    </script>
@endsection
