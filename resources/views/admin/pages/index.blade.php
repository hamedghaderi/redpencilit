@extends('layouts.dashboard')

@section('content')
    <div class="p-4">
        <h1 class="text-xl mb-4">{{ ucwords(__('Edit pages')) }}</h1>

        <hr>

        <ul class="list-reset flex">
            <li class="bg-purple w-1/6 rounded cursor-pointer shadow-lg hover:shadow-none ml-4">
                <a
                        class="text-white py-4 w-full inline-block text-center"
                        href="{{ route('admin.pages.home', app() ->getLocale()) }}"
                >
                    <i class="las la-edit"></i>
                    {{ __('home') }}
                </a>
            </li>

            <li class="bg-red w-1/6 rounded cursor-pointer shadow-lg hover:shadow-none ml-4">
                <a
                        class="text-white py-4 w-full inline-block text-center"
                        href="{{ route('admin.pages.about', app() ->getLocale()) }}"
                >
                    <i class="las la-edit"></i>
                    {{ __('about') }}
                </a>
            </li>

            <li class="bg-green w-1/6 rounded cursor-pointer shadow-lg hover:shadow-none ml-4">
                <a
                        class="text-white py-4 w-full inline-block text-center"
                        href="{{ route('admin.pages.contact', app() ->getLocale()) }}"
                >
                    <i class="las la-edit"></i>
                    {{ __('contact') }}
                </a>
            </li>

            <li class="bg-yellow w-1/6 rounded cursor-pointer shadow-lg hover:shadow-none">
                <a
                        class="text-white py-4 w-full inline-block text-center"
                        href="{{ route('admin.pages.services', app() ->getLocale()) }}"
                >
                    <i class="las la-edit"></i>
                    {{ __('services') }}
                </a>
            </li>
        </ul>
    </div>
@endsection
