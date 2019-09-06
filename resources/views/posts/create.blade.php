@extends('layouts.dashboard')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/vendor/trix.css') }}">
@endsection

@section('content')

    <div class="flex mb-12">
        <div class="w-1/2">
            <div class="p-6">
                <h3 class="dashboard-title">ایجاد پست جدید</h3>
            </div>
        </div>
    </div>

    <hr>

    <form method="POST" action="/posts">
        @csrf

        <div class="form-group">
            <label for="title">عنوان پست جدید</label>
            <input type="text" class="input mb-2" name="title">

            @if ($errors->has('title'))
                <div class="feedback feedback--invalid">{{ $errors->first('title') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="body">محتوای پست</label>
            <wysiwyg name="body" class="mb-2" host="{{ asset('/') }}"></wysiwyg>

            @if ($errors->has('body'))
                <div class="feedback feedback--invalid">{{ $errors->first('body') }}</div>
            @endif
        </div>

        <button class="button button--primary">انتشار پست</button>
    </form>

@endsection