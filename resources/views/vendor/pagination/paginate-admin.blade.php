<div class="d-flex justify-content-center">
    <div class="d-flex flex-wrp py-2 mr-3">
        @if ($paginator->hasPages())
            @if ($paginator->onFirstPage())
                <a href="javascript:" class="btn btn-icon btn-sm btn-light-success mr-2 my-1 disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <i class="ki ki-bold-double-arrow-back icon-xs"></i>
                </a>
            @else
                <a class="btn btn-icon btn-sm btn-light-success mr-2 my-1 paginate-go" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="ki ki-bold-double-arrow-back icon-xs"></i>
                </a>
            @endif
            <!--<ul class="page-navigation-nav">-->           

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-success mr-2 my-1 disabled">{{ $element }}</a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="{{ $url }}" class="btn btn-icon btn-sm border-0 btn-hover-success active mr-2 my-1 paginate-go">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" class="btn btn-icon btn-sm border-0 btn-hover-success mr-2 my-1 paginate-go">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
            <!--</ul>-->
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-icon btn-sm btn-light-success mr-2 my-1 paginate-go" rel="next" aria-label="@lang('pagination.next')">
                    <i class="ki ki-bold-double-arrow-next icon-xs"></i>
                </a>                
            @else
                <a href="javascript:" class="btn btn-icon btn-sm btn-light-success disabled mr-2 my-1" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <i class="ki ki-bold-double-arrow-next icon-xs"></i>
                </a>
            @endif        
        @endif
    </div>
</div>