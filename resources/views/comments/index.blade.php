@extends('layouts.dashboard')

@section('content')
    <div class="mb-12">

        <div class="px-6">
            <h3 class="dashboard-title mb-8">نظرات کاربران</h3>

            <hr>

            <div class="row mb-3">
                <comments :collection="{{ json_encode($comments) }}"></comments>

                {{ $comments->links() }}
            </div>
        </div>

        <hr>

        <div class="px-6">
            <h3 class="dashboard-title mb-8">نظرات اضافه شده به صفحه اصلی</h3>

            <div class="row mb-3">
                @foreach($testimonials as $testimonial)
                    <div class="card mb-4 flex">
                        <span class="text-grey-dark text-sm">{{ $testimonial->comment->name }}</span> - {{
                        $testimonial->body }}

                        <form method="POST" class="mr-auto"
                              action="{{ route('testimonials.delete', ['locale' => app()->getLocale(), 'id' => $testimonial->id]) }}">
                            @csrf
                            @method('DELETE')

                            <button class="button button--default">
                                {{__('undo')}}
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection