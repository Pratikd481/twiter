@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><a class="page-link" href="javascript:void(0);">Previous</a></li>
            @else
                <li class="page-item "><a class="page-link"
                        href="{{ $paginator->previousPageUrl() }}">Previous</a></li>
            @endif

            @isset($elements)
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                    @endif
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item disabled"><a href="javascript:void(0);"
                                        class="page-link active">{{ $page }}</a></li>
                            @else
                                <li class="page-item"><a href="{{ $url }}"
                                        class="page-link">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endisset
            @if ($paginator->hasMorePages())
                <li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" class="page-link">Next</a></li>
            @else
                <li class="page-item disabled"><a href="javascript:void(0);" class="page-link">Next</a></li>
            @endif
        </ul>
    </nav>

@endif
