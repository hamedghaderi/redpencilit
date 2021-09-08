@php
    $class = 'mr-4';

    if (app()->getLocale() === 'fa') {
        $class = 'ml-4';
    }
@endphp

<button {{ $attributes->merge(['class' => 'bg-primary text-white px-4 py-2 rounded-lg hover:bg-red-500 transition focus:ring-4 focus:ring-red-500 focus:ring-opacity-20 ' . $class]) }}>
    {{ $slot }}
</button>
