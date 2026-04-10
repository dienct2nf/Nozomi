@if ($paginator->hasPages())
    <!-- Pagination -->
    <nav class="pager" role="navigation" aria-labelledby="pagination-heading">
        <ul class="pager__items js-pager__items">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pager__item disabled">
                    <a class="disabled">‹ Trước</a>
                </li>
            @else
                <li class="pager__item pager__item--previous">
                    <a href="{{ $paginator->previousPageUrl() }}">‹ Trước</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pager__item is-active">
                                <a><span>{{ $page }}</span></a>
                            </li>
                        @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                            <li class="pager__item">
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @elseif ($page == $paginator->lastPage() - 1)
                            <li class="pager__item">
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pager__item pager__item--next">
                    <a class="next page-numbers" href="{{ $paginator->nextPageUrl() }}">Sau ›</a>
                </li>
            @else
            <li class="pager__item disabled">
                <a class="disabled">Sau ›</a>
            </li>
            @endif
        </ul>
    </nav>
    <!-- Pagination -->
@endif
