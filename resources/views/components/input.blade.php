@props(['name', 'type' => 'text'])

@php

    $class = '';

    if (app()->getLocale() === 'fa') {
        $class = 'pr-10';
    } else {
        $class = 'pl-10';
    }

@endphp

<div class="relative mb-8">
    <input type="{{ $type }}" name="{{ $name }}"
           {{ $attributes->merge(['class' => 'rounded-lg border px-4 py-2 w-full block focus:outline-none focus:ring-4 focus:ring-gray-500 focus:ring-opacity-20 focus:border-gray-500 ' . $class]) }}
           placeholder="{{ __($name) }}"
    >

    {{ $slot }}

    @error($name)
    <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror

</div>
