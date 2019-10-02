<div class="post">
    <span class="post__date"> {{ $post->created_at->diffForHumans() }}</span>

    @if ($post->thumbnail)
        <div class="post__thumb" style="background-image: url('{{ asset($post->thumbnail) }}');"></div>
    @else
        <div class="post__thumb"
             style="background-image: url({{ asset('images/blog_post_default.svg') }});">
        </div>
    @endif

    <div class="post__body w-1/2">
        <span class="post__author text-sm">{{ $post->owner->name }}</span>

        <h3 class="post__title">
            <a href="{{ $post->path() }}">
                {{ $post->title }}
            </a>
        </h3>

        <div class="article mb-4">
            {!! str_limit($post->body, 100)  !!}
        </div>

        @can('create-posts')
            <div class="flex">
                <a class="button button--smooth--primary button--sm ml-3" href="{{ $post->path() . '/edit' }}">
                    ویرایش پست
                </a>

                <form action="{{ $post->path() }}" method="POST">
                    @csrf
                    @method("DELETE")

                    <button class="button button--smooth--danger button--sm">حذف پست</button>
                </form>
            </div>
        @endcan
    </div>
</div>