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
            <div class="slider mb-12">
                <div>
                    <div class="bg-white shadow rounded p-8">
                        <div class="text-center mb-8">
                            <img src="{{ asset('images/slide-1.svg') }}" class="h-32" alt="image">
                        </div>

                        <h2 class="text-grey-darkest text-xl mb-3 leading-normal">
                            {{ ucfirst(__('have a thesis expert improve your writing')) }}
                        </h2>

                        <p class="text-grey-dark leading-loose">
                            {{ __('Hand in your thesis or dissertation with confidence. We can help you with our academic Proofreading & Editing service, Structure Check and Clarity Check. We improve your language mistakes directly and you’ll receive feedback to help you become a better writer.') }}</p>
                    </div>
                </div>

                <div>
                    <div class="bg-white shadow rounded p-8">
                        <div class="text-center mb-8">
                            <img src="{{ asset('images/slide-2.svg') }}" class="h-32" alt="image">
                        </div>

                        <h2 class="text-grey-darkest text-xl mb-3 leading-normal">
                            {{ ucfirst(__('Choose the best PhD dissertation editing service with Scribbr')) }}
                        </h2>

                        <p class="text-grey-dark leading-loose">
                            {{ __('Hand in your thesis or dissertation with confidence. We can help you with our academic Proofreading & Editing service, Structure Check and Clarity Check. We improve your language mistakes directly and you’ll receive feedback to help you become a better writer.') }}
                        </p>
                    </div>
                </div>

                <div>
                    <div class="bg-white rounded shadow p-8">
                        <div class="text-center mb-8">
                            <img src="{{ asset('images/slide-3.svg') }}" class="h-32" alt="image">
                        </div>

                        <h2 class="text-grey-darkest text-xl mb-3 leading-normal">
                            {{ ucfirst(__('Essay Editing Service')) }}
                        </h2>

                        <p class="text-grey-dark leading-loose">
                            {{ __('Hand in your thesis or dissertation with confidence. We can help you with our academic Proofreading & Editing service, Structure Check and Clarity Check. We improve your language mistakes directly and you’ll receive feedback to help you become a better writer.') }}
                        </p>
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
            items: 1,

            responsive: {
                900: {
                    itmes: 2,
                    edgePadding: 20,
                    gutter: 20
                },

                1024: {
                    items: 3,
                    edgePadding: 20,
                    gutter: 20
                }
            }
        });
    </script>
@endsection
