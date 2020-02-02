@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <h1>{{ ucwords(__('list of pages')) }}</h1>

        <ul>
            <li><a href="{{ route('admin.pages.home', app()->getLocale()) }}">{{ __('home') }}</a></li>
        </ul>
    </div>
@endsection