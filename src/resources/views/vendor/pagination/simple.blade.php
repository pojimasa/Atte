@if ($paginator->hasPages())
    <ul class="pagination justify-content-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true" style="font-size: 1.2em;">&lsaquo;前</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}&date={{ request('date') }}" rel="prev" aria-label="@lang('pagination.previous')" style="font-size: 1.2em;">&lsaquo;前</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}&date={{ request('date') }}" rel="next" aria-label="@lang('pagination.next')" style="font-size: 1.2em;">後&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true" style="font-size: 1.2em;">後&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif
