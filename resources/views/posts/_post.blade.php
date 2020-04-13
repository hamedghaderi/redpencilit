<div class="post">
    <span class="post__date">
        {{ $post->created_at->diffForHumans() }}
    </span>

    <a href="{{route('posts.show', [app()->getLocale(), $post])}}">
        @if ($post->thumbnail)
            <div
                    class="post__thumb"
                    style="background-image: url('{{ asset($post->thumbnail) }}');"
            ></div>
        @else
            <div
                    class="post__thumb"
                    style="background-image: url({{ asset('images/blog_post_default.svg') }});"
            ></div>
        @endif
    </a>

    <div class="post__body w-1/2">
        <span class="post__author text-sm">
            {{ $post->owner->name }}
        </span>

        <h3 class="post__title">
            <a href="{{ route('posts.show', ['locale' => app()->getLocale(), 'post' => $post->id]) }}">
                {{ $post->title }}
            </a>
        </h3>

        <div class="article mb-4">
            {!! str_limit($post->excerpt, 100)  !!}
        </div>

        @can('create-posts')
            <div class="flex">
                <a
                        class="button button--smooth--primary button--sm mr-3"
                        href="{{ route ('posts.edit', [app() ->getLocale(), $post]) }}"
                >
                    {{ __('Edit Post') }}
                </a>

                <form action="{{ route('posts.destroy', [app()->getLocale(), $post]) }}" method="POST">
                    @csrf
                    @method("DELETE")

                    <button class="button button--smooth--danger button--sm">
                        {{ __('Delete Post') }}
                    </button>
                </form>
            </div>
        @endcan
    </div>
</div>
