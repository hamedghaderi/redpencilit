@php
    $class = '';

    if (app()->getLocale() === 'fa') {
        $class = 'mr-4 right-0';
    } else {
        $class = 'ml-4 left-0';
    }
@endphp

<i {{ $attributes->merge(['class' => 'absolute top-1.5 text-xl z-10 text-gray-600 ' . $class]) }}></i>
