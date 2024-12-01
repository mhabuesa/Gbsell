@if ($paginator->hasPages())
<nav class="d-md-flex justify-content-end align-items-center border-top pt-3" aria-label="Page navigation example">
    <!-- Showing results -->
    <div class="text-center text-md-left mb-3 mb-md-0">
        Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} results
    </div>

    <!-- Pagination links -->
    <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start">
        {{-- Previous Page Link --}}
        @if ($products->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($products->links()->elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $products->currentPage())
                        <li class="page-item"><a class="page-link current" href="{{ $url }}">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($products->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif
    </ul>
</nav>

@endif
