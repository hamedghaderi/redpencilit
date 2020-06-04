@extends('layouts.dashboard')

@section('content')
    <h2 class="mb-8">{{ ucwords(__('update about content')) }}</h2>

    <form class="mb-8" method="POST" action="{{ route('admin.about.store', app()->getLocale()) }}">
        @csrf
        @method('PATCH')

        <div class="card mb-4">
            <div class="flex -mx-3">
                <div class="md:w-full mx-3">
                    <label class="label mb-3" for="homeHeroTitle">متن</label>
                    <textarea
                            class="input w-full h-48 whitespace-pre-wrap"
                            type="text"
                            name="faBody"
                    >{{ $page->data['fa']['Body'] ?? '' }}</textarea>
                </div>
            </div>

            <hr>

            <div class="flex -mx-3">
                <div class="w-full mx-3">
                    <label class="label mb-3" for="homeHeroBody">Body Text</label>
                    <textarea class="input w-full h-48 whitespace-pre-wrap" type="text" name="enBody">{{
                    $page->data['en']['Body']
                    ?? ''
                    }}</textarea>
                </div>
            </div>
        </div>


        <button class="button button--primary">{{ __('save') }}</button>
    </form>
@endsection
