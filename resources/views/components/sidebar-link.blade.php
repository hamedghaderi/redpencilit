@props(['route', 'icon', 'text'])

@php
    $currentRouteName = \Illuminate\Support\Facades\Route::current()->getName();
@endphp


<li class="py-3 mt-6 mb-6 cursor-pointer @if($currentRouteName === $route) text-white bg-gradient-to-b from-red-500 to-red-700 rounded-2xl shadow-xl px-4 py-2 hover:shadow-lg @endif">
    <a href="{{ route($route) }}" class="inline-flex items-center w-full">
        <i class="gg-{{ $icon }} text-xl
            @if($currentRouteName === $route) text-white @else text-gray-400 @endif
        @if(app()->getLocale() === 'en') mr-2 @else ml-2 @endif"></i>
        {{ ucfirst(__($text)) }}


        @if ($currentRouteName === $route)
            @if (app()->getLocale() === 'en')
                <span class="ml-auto text-2xl"><i class="gg-arrow-right"></i></span>
            @else
                <span class="mr-auto text-2xl"><i class="gg-arrow-left"></i></span>
            @endif
        @endif
    </a>
</li>

<style>
    :root {
        --ggs: .9;
    }
</style>
