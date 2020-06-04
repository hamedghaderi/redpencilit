@extends('layouts.dashboard')

@section('content')
    <h2 class="mb-8">{{ ucwords(__('update home page content')) }}</h2>

    <form class="mb-8" method="POST" action="{{ route('admin.home.store', app()->getLocale()) }}">
        @csrf
        @method('PATCH')

        @include('admin.pages._hero')

        @include('admin.pages._service')

        @include('admin.pages._connection')

        @include('admin.pages._request')

        @include('admin.pages._testimonial')

        @include('admin.pages._team')

        <button class="button button--primary">{{ __('save') }}</button>
    </form>
@endsection
