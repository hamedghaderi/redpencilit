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
            @include('pages._slider')
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
