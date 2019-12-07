@extends('layouts.dashboard')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/vendor/trix.css') }}">
@endsection

@section('content')
    <div class="bg-white px-12 py-8 shadow rounded">
        <div class="flex">
            <div class="w-1/2">
                <h3 class="dashboard-title py-4 inline-flex items-center">
                    <i class="la la-newspaper text-indigo-dark ml-2 text-2xl"></i>
                    <span>ویرایش پست</span>
                </h3>
            </div>
        </div>

        <hr>

        <form method="POST"
              action="{{ route('posts.update', [app()->getLocale(), $post]) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="title">عنوان پست</label>
                <input type="text" class="input mb-2" name="title" value="{{ $post->title }}">

                @if ($errors->has('title'))
                    <div class="feedback feedback--invalid">{{ $errors->first('title') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="title">چکیده پست (در یک پاراگراف کوتاه)</label>
                <input type="text" class="input mb-2" name="excerpt" value="{{ old('excerpt') ?: $post->excerpt }}">

                @if ($errors->has('excerpt'))
                    <div class="feedback feedback--invalid">{{ $errors->first('excerpt') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="body">محتوای پست</label>
                <wysiwyg name="body" class="mb-2" host="{{ asset('/') }}" value="{{ $post->body  }}"></wysiwyg>

                @if ($errors->has('body'))
                    <div class="feedback feedback--invalid">{{ $errors->first('body') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="thumbnail">آپلود عکس پیش‌فرض برای پست</label>
                <input type="file" name="thumbnail">

                @if ($errors->has('thumbnail'))
                    <div class="feedback feedback--invalid">{{ $errors->first('thumbnail') }}</div>
                @endif
            </div>

            <button class="button button--primary">انتشار پست</button>
        </form>
    </div>
@endsection