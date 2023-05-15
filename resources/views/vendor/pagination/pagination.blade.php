@if ($paginator->hasPages())
    <!--<nav>-->
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex flex-wrap py-2 mr-3">
                @if ($paginator->onFirstPage())
                    <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-light mr-2 my-1 disabled" aria-label="@lang('pagination.previous')"><i class="fa fa-arrow-left icon-xs"></i></a>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-icon btn-sm btn-light mr-2 my-1 paginate-go" aria-label="@lang('pagination.previous')"><i class="fa fa-arrow-left icon-xs"></i></a>
                @endif

                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <a href="javascript:void(0)" class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1">.{{ $element }}</a>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <a href="javascript:void(0)" class="btn btn-icon btn-sm border-0 btn-light btn-hover-primary active mr-2 my-1">{{ $page }}</a>
                            @else
                                <a href="{{ $url }}" class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1 paginate-go"> {{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                 {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a class="btn btn-icon btn-sm btn-light mr-2 my-1 paginate-go" href="{{ $paginator->nextPageUrl() }}" aria-label="@lang('pagination.next')"><i class="fa fa-arrow-right icon-xs"></i></a>
                @else
                    <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-light mr-2 my-1 disabled" aria-label="@lang('pagination.next')"><i class="fa fa-arrow-right icon-xs"></i></a>
                @endif
            </div>
        </div>
    <!--</nav>-->
@endif
