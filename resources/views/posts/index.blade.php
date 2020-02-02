@extends('layouts.blog')

@section('content')
    <div class="container">
        <div class="w-3/4 mx-auto mb-8">

            <div class="flex items-center mb-2">
                <h1 class="mb text-2xl">{{ ucwords(__('blog')) }}</h1>

                <p class="@if (app()->getLocale() === 'fa') mr-auto @else ml-auto @endif text-grey-darker text-sm">
                    {{ ucwords(__('total posts')) }}:
                    {{ $posts->total() }}
                    {{ __('post(s)') }}
                </p>
            </div>

            <hr>

            <div class="search-box">
                <form action="{{ route('posts.index', app()->getLocale()) }}" method="get">
                    <input type="search" class="search-input" name="q" placeholder="{{ __('I am searching for') }}...">

                    <span class="search-icon">
                        <i class="fas fa-search"></i>
                    </span>
                </form>
            </div>
        </div>

        <div class="w-3/4 mx-auto">
            @forelse($posts as $post)
                @include('posts._post', $post)
            @empty
                <h4>{{ __('Posts List') }}</h4>

                <div class="article">
                    <p>{{ __('There is\'nt any post yet!') }}</p>
                </div>
            @endforelse

            {{  $posts->links() }}
        </div>
    </div>


@endsection