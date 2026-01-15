@if ($paginator->hasPages())
    
        <ul >
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li  aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <i class="far fa-arrow-left"></i>
                </li>
                
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="far fa-arrow-left"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li  aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span class="active">{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="far fa-arrow-right"></i></a>
                </li>
            @else
                <li class="active" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <i class="far fa-arrow-right"></i>
                </li>
            @endif
        </ul>
@endif
