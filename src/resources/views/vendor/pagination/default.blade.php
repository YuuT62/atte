@if ($paginator->hasPages())
<div class="paginationWrap">
    <table class="pagination-table" >
    <tr class="pagination" role="navigation">

{{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <td  aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a class="pagination-transition" tabindex="-1"><</a>
            </td>
        @else
            <td>
                <a class="pagination-transition" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><</a>
            </td>
        @endif



{{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <td aria-disabled="true">{{ $element }}</td>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <td aria-current="page"><a class="active" href="#">{{ $page }}</a></td>
                    @else
                        <td><a href="{{ $url }}">{{ $page }}</a></td>
                    @endif
                @endforeach
            @endif
        @endforeach



{{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <td>
                <a class="pagination-transition" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">></a>
            </td>
        @else
            <td aria-disabled="true" aria-label="@lang('pagination.next')">
                <a class="pagination-transition" tabindex="-1">></a>
            </td>
        @endif
    </tr>
</table>
</div>
@endif