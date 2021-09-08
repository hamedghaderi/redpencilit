@php
    $direction = \LaravelLocalization::getCurrentLocale() === 'fa' ? 'mr-auto': 'ml-auto';
@endphp


<div {{ $attributes->merge(['class' => 'relative z-50 ' . $direction]) }}   x-data="{isOpen: false}" x-cloak>
    <div tabindex="1"
         x-on:click="isOpen = !isOpen"
         x-on:click.away="isOpen = false">
        {{ $trigger }}
    </div>

    <div x-show="isOpen"
         class="absolute top-full  bg-white shadow-lg rounded w-64 py-2 px-4 text-sm @if(app()->getLocale() === 'en') right-0 @else left-0 @endif"
    >
        {{ $content }}
    </div>
</div>
