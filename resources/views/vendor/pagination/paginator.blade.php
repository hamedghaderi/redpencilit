@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled page-caret" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <i class="fas fa-angle-right"></i>
            </li>
        @else
            <li class="page-item page-caret">
                <a class="page-link" href="{{ app()->getLocale() . '/' . $paginator->previousPageUrl() }}" rel="prev"
                   aria-label="@lang('pagination.previous')">
                    <i class="fas fa-angle-right"></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ app()->getLocale() . '/' . $url }}">{{
                        $page
                        }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item page-caret">
                <a class="page-link" href="{{ app()->getLocale() . '/' . $paginator->nextPageUrl() }}" rel="next"
                   aria-label="@lang
                ('pagination
                .next')">
                    <i class="fas fa-angle-left"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled page-caret" aria-disabled="true" aria-label="@lang('pagination.next')">
               <i class="fas fa-angle-left"></i>
            </li>
        @endif
    </ul>
@endif
