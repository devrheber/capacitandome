@if ($paginator->hasPages())
    <!--<nav>-->
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="javascript:" class="page-go page-prev disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <i class="la la-arrow-left" aria-hidden="true"></i>
            </a>
        @else
            <a class="page-go page-prev" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                <i class="la la-arrow-left" aria-hidden="true"></i>
            </a>
        @endif
        <ul class="page-navigation-nav">           

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true">
                        <a href="#" class="page-go-link disabled">{{ $element }}</a>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page">
                                <span class="page-go-link">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a class="page-go-link" href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            
            <a class="page-go page-next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                <i class="la la-arrow-right"></i>
            </a>
            
        @else
            <li class="page-go page-next disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <i class="la la-arrow-right" aria-hidden="true"></i>
            </li>
        @endif
    <!--</nav>-->
@endif
