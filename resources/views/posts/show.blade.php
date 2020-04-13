@extends('layouts.blog')

@section('content')
    @if ($post->thumbnail)
        <div class="hero mb-8" style="background-image: url('{{ asset($post->thumbnail) }}')">
            <div class="relative z-10 w-full text-center flex items-center flex-wrap flex-col">
                <h2 class="hero__title text-lg md:text-3xl">{{ $post->title }}</h2>

                <div class="hero__avatar w-12 h-12 md:w-24 md:h-24  mb-2">
                    @if ($post->owner->avatar)
                        <img class="rounded-full" src="/{{ $post->owner->avatar }}" alt="{{ $post->owner->name }}">
                    @else
                        <img src="{{ asset('images/avatar.svg') }}" alt="avatar">
                    @endif
                </div>

                <p class="text-white z-10 relative mb-2 text-sm md:text-normal">{{ $post->owner->name }}</p>
                <p class="text-white z-10 relative text-sm md:text-normal">{{ $post->created_at->diffForHumans() }}</p>

                @can('manage-posts')
                    <a class="bg-black text-white p-1 rounded text-xs mt-4 hover:bg-white hover:text-black
                    inline-flex items-center"
                       href="{{ route('posts.edit', [app() ->getLocale(), $post]) }}">
                        <i class="la la-edit @if (app()->getLocale() === 'fa') ml-1 @else mr-1 @endif"></i>
                        <span>{{ __('Edit post') }}</span>
                    </a>
                @endcan
            </div>
        </div>
    @else
        <div class="hero" style="background-image: url('{{ asset('images/blog_post_default.svg') }}')">
            <h2 class="hero__title text-lg"> {{ $post->title }}</h2>
        </div>
    @endif

    <div class="container mb-12">
        <div class="w-1/2 mx-auto">
            <div class="article">
                {!! customizePostBody($post->body)  !!}
            </div>

            <hr>

            <favorite class="mr-auto" :post="{{ $post }}"></favorite>
        </div>
    </div>

@endsection

@section('script')
    <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
@endsection
