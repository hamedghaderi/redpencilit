@extends('layouts.dashboard')

@section('content')
    <h2 class="mb-8">{{ ucwords(__('update services content')) }}</h2>

    <hr>

    <div class="card mb-8">
        <h4>ایجاد سرویس جدید</h4>

        <hr>

        <form
                class="mb-8"
                method="POST"
                action="{{ route('admin.page-service.store', app()->getLocale()) }}"
                enctype="multipart/form-data"
        >
            @csrf

            <div class="flex -mx-3">
                <div class="md:w-1/2 mx-3">
                    <label class="label mb-3" for="faTitle">عنوان</label>
                    <input
                            id="faTitle"
                            class="input w-full whitespace-pre-wrap"
                            type="text"
                            name="faTitle"
                            value="{{ old('faTitle') }}"
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
                    >{{ old('faDescription')  }}</textarea>

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
                            value="{{ old('enTitle') }}"
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
                    >{{ old('enDescription')  }}</textarea>
                    @error('enDescription')
                    <p class="feedback feedback--invalid"> {{ $message }} </p>
                    @enderror
                </div>
            </div>

            <hr>

            <div class="w-full mb-12">
                <label for="service-icon">{{ __('service icon') }}</label>
                <input type="file" name="service-icon">
                @error('service-icon')
                <p class="feedback feedback--invalid"> {{ $message }} </p>
                @enderror
            </div>

            <button class="button button--primary">{{ __('save') }}</button>
        </form>
    </div>

    <div class="card mb-8 pb-8">
        @foreach($services as $service)
            <div class="flex items-center text-sm text-grey-dark {{ !$loop->last ? 'mb-8 border-b pb-8' : '' }}">
                <div class="pl-4">
                    <div class="w-12 h-12 rounded-full"
                         style="background-image: url('{{asset('storage/' . $service->path)}}'); background-position:
                                 center center; background-size: cover; background-repeat: no-repeat;">

                    </div>
                </div>

                <div class="flex-1">
                    {{ $service->title[app()->getLocale()] }}
                </div>

                <div class="flex-1">
                    <a
                            class="button button--smooth--primary"
                            href="{{ route('admin.page-service.edit', [app()->getLocale(), $service->id]) }}"
                    >
                        {{ __('Edit') }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>


@endsection
