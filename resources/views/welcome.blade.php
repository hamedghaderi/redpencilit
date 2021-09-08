<x-layouts.home>
    <section class="relative h-96 lg:h-160 bg-gray-100">
        <img
                src="{{ asset('images/1.svg') }}"
                alt="a girl with a computer"
                class="absolute h-full z-0 top-0 opacity-40 md:opacity-100  @if(LaravelLocalization::getCurrentLocale() === 'fa') left-0 -left-40 @else -right-40 transform rotate-y-180 @endif"
        >

        <div class="px-8 md:px-24 pt-8 md:pb-0 relative z-10">
            <x-nav/>
        </div>

        @include('hero')
    </section>


    @include('home-services')

    @include('contact-ways')

    @include('request-steps')

    @include('testimonial')

    @include('team')
</x-layouts.home>

@section('script')
    <script>
        const scrollAnimation = window.sal();

        scrollAnimation.enable();
    </script>
@endsection
