@if ($paginator->hasPages())
<div class="pagination_wrap">
    <ul>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><a class="disabled" href="#"><i class="ti-angle-left"></i> </a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}"><i class="ti-angle-left"></i> </a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
         <li><a href=""><span>{{ $element }}</span></a></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
            <li class="active"><a><span>{{ $page }}</span></a></li>
        @else
            <li><a href="{{ $url }}"><span>{{ $page }}</span></a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())


            <li><a href="{{ $paginator->nextPageUrl() }}"><span><i class="ti-angle-right"></i></span></a></li>

        @else
        <li class="disabled"><a class="disabled" href=""><span class="disabled"><i
                        class="ti-angle-right"></i></span></a></li>
        @endif
    </ul>
</div>
@endif