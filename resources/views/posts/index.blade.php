@extends('layouts.blog')

@section('content')

    <div class="container">
        <div class="w-3/4 mx-auto mb-8">

            <div class="flex items-center mb-2">
                <h1 class="mb text-2xl">وبلاگ</h1>

                <p class="mr-auto text-grey-darker">تعداد کل پست‌ها: {{ $posts->total() }} پست</p>
            </div>

            <hr>

            <div class="search-box">
                <form action="/posts" method="get">
                    <input type="search" class="search-input" name="q" placeholder="در جستجوی آنم ...">

                    <span class="search-icon">
                        <i class="fas fa-search"></i>
                    </span>
                </form>
            </div>
        </div>

        <div class="w-3/4 mx-auto">
            @forelse($posts as $post)
                @include('posts._post', $post)
            @empty
                <h4>لیست پست‌ها</h4>

                <div class="article">
                    <p>هنوز هیچگونه پستی ثبت نشده است.</p>
                </div>
            @endforelse

            {{  $posts->links() }}
        </div>
    </div>


@endsection