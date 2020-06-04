@extends('layouts.dashboard')

@section('content')
    <h2 class="mb-8">{{ ucwords(__('update services content')) }}</h2>

    <hr>

    <div class="card mb-8">
        <form
                class="mb-8"
                method="POST"
                action="{{ route('admin.page-service.update', [app()->getLocale(), $pageService]) }}"
                enctype="multipart/form-data"
        >
            @csrf
            @method('PATCH')

            <div class="flex -mx-3">
                <div class="md:w-1/2 mx-3">
                    <label class="label mb-3" for="faTitle">عنوان</label>
                    <input
                            id="faTitle"
                            class="input w-full whitespace-pre-wrap"
                            type="text"
                            name="faTitle"
                            value="{{ $pageService->title['fa'] }}"
                    >

                    @error('faTitle')
                    <p class="feedback feedback--invalid"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="w-1/2 mx-3">
                    <label class="label mb-3" for="faDescription">توضیحات</label>
                    <textarea
                            id="faDescription"
                            class="input w-full h-48 whitespace-pre-wrap"
                            type="text"
                            name="faDescription"
                    >{{ $pageService->description['fa']  }}</textarea>

                    @error('faDescription')
                    <p class="feedback feedback--invalid"> {{ $message }} </p>
                    @enderror
                </div>
            </div>

            <hr>

            <div class="flex -mx-3">
                <div class="md:w-1/2 mx-3">
                    <label class="label mb-3" for="enTitle">Title</label>
                    <input
                            id="enTitle"
                            class="input w-full whitespace-pre-wrap"
                            type="text"
                            name="enTitle"
                            value="{{ $pageService->title['en'] }}"
                    >
                    @error('enTitle')
                    <p class="feedback feedback--invalid"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="w-1/2 mx-3">
                    <label class="label mb-3" for="enDescription">Descriptions</label>
                    <textarea
                            id="enDescription"
                            class="input w-full h-48 whitespace-pre-wrap"
                            type="text"
                            name="enDescription"
                    >{{ $pageService->description['en']  }}</textarea>

                    @error('enDescription')
                    <p class="feedback feedback--invalid"> {{ $message }} </p>
                    @enderror
                </div>
            </div>

            <hr>

            <div class="flex">
                <div class="w-1/2 mb-12">
                    <label for="service-icon">{{ __('service icon') }}</label>
                    <input type="file" name="service-icon" value="{{ asset('storage/' . $pageService->path) }}">
                    @error('service-icon')
                    <p class="feedback feedback--invalid"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="w-1/2">
                    <img class="w-full" src="{{ asset('storage/' . $pageService->path) }}">
                </div>
            </div>

            <button class="button button--primary">{{ __('save') }}</button>
        </form>
    </div>

@endsection
