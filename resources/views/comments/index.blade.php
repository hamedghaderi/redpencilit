@extends('layouts.dashboard')

@section('content')
    <div class="mb-12">

        <div class="px-6">
            <h3 class="dashboard-title mb-8">
                {{ __('User Comments') }}
            </h3>

            @if($comments->count())
                <hr>

                <div class="row mb-3">
                    <comments :collection="{{ json_encode($comments) }}"></comments>

                    {{ $comments->links() }}
                </div>

                <hr>
            @else
                <p class="text-grey-dark mb-8 border-b pb-8">هنوز هیچ نظری ثبت نشده است</p>
            @endif
        </div>


        <div class="px-6">
            <h3 class="dashboard-title mb-2">
                {{ __('Comments added to the home page') }}
            </h3>
            <p class="mb-8 text-grey-dark">
                {{ __('Add only 5 comments to the home page.') }}
            </p>

            <div class="row mb-3">
                @forelse($testimonials as $testimonial)
                    <div class="card mb-4 flex flex-wrap">
                        <span class="text-grey-dark text-sm">
                            {{ $testimonial->comment->name }}
                        </span>
                        <p class="mb-8 md:mb-0"> - {{ $testimonial->body }}</p>

                        <form method="POST"
                              class="@if (app()->getLocale() === 'fa') mr-auto @else ml-auto @endif"
                              action="{{ route('testimonials.delete', ['locale' => app()
                              ->getLocale(), $testimonial]) }}">
                            @csrf
                            @method('DELETE')

                            <button class="button button--default">
                                {{__('undo')}}
                            </button>
                        </form>
                    </div>

                @empty
                    <p class="text-grey-dark">هنوز هیچ نظری به صفحه اصلی اضافه نشده است.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
