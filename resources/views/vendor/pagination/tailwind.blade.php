@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="pagination">
        <ul style="display: flex; list-style: none; padding: 0; justify-content: center;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li style="margin: 0 5px; color: #6c757d; padding: 5px 10px; border: 1px solid #dee2e6; border-radius: 4px;">
                    &laquo;
                </li>
            @else
                <li style="margin: 0 5px;">
                    <a href="{{ $paginator->previousPageUrl() }}" style="color: #007bff; text-decoration: none; padding: 5px 10px; border: 1px solid #dee2e6; border-radius: 4px; display: block;">
                        &laquo;
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li style="margin: 0 5px; color: #6c757d; padding: 5px 10px; border: 1px solid #dee2e6; border-radius: 4px;">
                        {{ $element }}
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li style="margin: 0 5px; background-color: #007bff; color: white; padding: 5px 10px; border: 1px solid #007bff; border-radius: 4px;">
                                {{ $page }}
                            </li>
                        @else
                            <li style="margin: 0 5px;">
                                <a href="{{ $url }}" style="color: #007bff; text-decoration: none; padding: 5px 10px; border: 1px solid #dee2e6; border-radius: 4px; display: block;">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li style="margin: 0 5px;">
                    <a href="{{ $paginator->nextPageUrl() }}" style="color: #007bff; text-decoration: none; padding: 5px 10px; border: 1px solid #dee2e6; border-radius: 4px; display: block;">
                        &raquo;
                    </a>
                </li>
            @else
                <li style="margin: 0 5px; color: #6c757d; padding: 5px 10px; border: 1px solid #dee2e6; border-radius: 4px;">
                    &raquo;
                </li>
            @endif
        </ul>
    </nav>
@endif