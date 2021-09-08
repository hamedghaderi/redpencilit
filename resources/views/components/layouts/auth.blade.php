@props(['banner'])

<x-layouts.base>
    <div class="h-screen flex">
        <div class="w-full lg:w-6/12 xl:w-5/12 h-screen py-8 px-24 flex items-center justify-center flex-wrap relative">
            {{ $slot }}
        </div>

        <div class="w-0 lg:w-6/12 xl:w-7/12 h-screen bg-cover bg-center bg-no-repeat"
             style="background-image: url({{ $banner }})"></div>
    </div>
</x-layouts.base>
