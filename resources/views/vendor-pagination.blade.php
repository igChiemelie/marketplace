@if ($paginator->hasPages())
<ul class="pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <li class="disabled"><span>&laquo;</span></li>
    @else
        <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <li class="disabled"><span>{{ $element }}</span></li>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="active"><span>{{ $page }}</span></li>
                @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
    @else
        <li class="disabled"><span>&raquo;</span></li>
    @endif
</ul>
@endif

<style>
    .pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
}

.pagination li {
    margin: 0 5px;
}

.pagination a,
.pagination span {
    display: inline-block;
    padding: 10px 16px;
    border-radius: 12px;               /* Rounded like vendor cards */
    background-color: #f5f5f5;         /* Card-like bg */
    color: #333;
    text-decoration: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Card shadow */
    transition: all 0.3s ease;
    min-width: 42px;
    text-align: center;
    font-weight: 500;
}

.pagination a:hover {
    background-color: #c01515;  /* Primary color hover */
    color: #fff;
    transform: translateY(-2px);
}

.pagination .active span {
    background-color: #c01515; /* Active page */
    color: #fff;
    font-weight: bold;
}

.pagination .disabled span {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Arrow buttons */
.pagination li:first-child a,
.pagination li:first-child span,
.pagination li:last-child a,
.pagination li:last-child span {
    font-weight: bold;
    font-size: 18px;
}

</style>