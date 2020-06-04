@extends('layouts.home')

@section('content')
    <section class="relative bg-contain bg-no-repeat home-hero" id="intro">
        <img
                src="{{ asset('images/1.svg') }}"
                alt="a girl with a computer"
                class="home-hero-bg @if (app()->getLocale () === 'en') en-home-hero-bg @endif"
        >

        <div class="px-8 md:px-24 pt-8 md:pb-0">
            @include('partials.nav-home')
        </div>

        @include('hero')
    </section>


    @include('home-services');

    @include('contact-ways')

    @include('request-steps')

    @include('testimonial')

   @include('team')
@endsection

@section('script')
    <script>
        const scrollAnimation = window.sal();

        scrollAnimation.enable();
    </script>
@endsection
