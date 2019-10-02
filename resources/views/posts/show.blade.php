@extends('layouts.blog')

@section('content')
    @if ($post->thumbnail)
        <div class="hero" style="background-image: url('{{ asset($post->thumbnail) }}')">
            <h2 class="hero__title">{{ $post->title }}</h2>

            <div class="hero__avatar mb-2">
                @if ($post->owner->avatar)
                    <img class="rounded-full" src="/{{ $post->owner->avatar }}" alt="{{ $post->owner->name }}">
                @else
                    <img src="{{ asset('images/avatar.svg') }}" alt="avatar">
                @endif
            </div>

            <p class="text-white z-10 relative mb-2">{{ $post->owner->name }}</p>
            <p class="text-white z-10 relative">{{ $post->updated_at->diffForHumans() }}</p>
        </div>
    @else
        <div class="hero" style="background-image: url('{{ asset('images/blog_post_default.svg') }}')">
            <h2 class="hero__title"> {{ $post->title }}</h2>
        </div>
    @endif

    <div class="container">
        <div class="w-1/2 mx-auto">
            <div class="article">
                {!! $post->body !!}
            </div>

            <hr>

            <favorite class="mr-auto" :post="{{ $post }}"></favorite>
        </div>


    </div>

@endsection