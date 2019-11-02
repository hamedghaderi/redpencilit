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
    </div>
@endsection