@extends('layouts.dashboard')

@section('content')
    <h2 class="mb-8">{{ ucwords(__('update contact content')) }}</h2>

    <form class="mb-8" method="POST" action="{{ route('admin.contact.store', app()->getLocale()) }}">
        @csrf
        @method('PATCH')

        <div class="card mb-4">
            <div class="flex flex-wrap mb-4 -mx-3">
                <div class="md:w-1/3 mx-3 mb-4">
                    <label class="label mb-3" for="homeHeroTitle">خلاصه متن</label>
                    <textarea
                            class="input w-full h-48 whitespace-pre-wrap"
                            name="faBody"
                    >{{ $page ? $page->data['fa']['Body'] : '' }}</textarea>
                </div>

                <div class="md:w-1/3 mx-3">
                    <label class="label mb-3" for="homeHeroTitle">میزان رضایت</label>
                    <input
                            class="input w-full whitespace-pre-wrap"
                            type="text"
                            name="faSatisfaction"
                            value="{{ $page ? $page->data['fa']['Satisfaction'] : '' }}"
                    >
                </div>
            </div>

            <hr>

            <div class="flex flex-wrap -mx-3">
                <div class="md:w-1/3 mx-3 mb-4">
                    <label class="label mb-3" for="homeHeroTitle">Summary Content</label>
                    <textarea
                            class="input w-full h-48 whitespace-pre-wrap"
                            name="enBody"
                    >{{ $page ? $page->data['en']['Body'] : '' }}</textarea>
                </div>

                <div class="md:w-1/3 mx-3">
                    <label class="label mb-3" for="homeHeroBody">Satisfaction Text</label>
                    <input
                            class="input w-full whitespace-pre-wrap"
                            type="text"
                            name="enSatisfaction"
                            value="{{ $page ? $page->data['en']['Satisfaction'] : '' }}"
                    >
                </div>
            </div>
        </div>


        <button class="button button--primary mb-12">{{ __('save') }}</button>
    </form>
@endsection
