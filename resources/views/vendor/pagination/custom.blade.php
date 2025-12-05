@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <ul style="display:inline-flex;gap:8px;list-style:none;padding:8px 12px;margin:0;background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;box-shadow:0 8px 24px rgba(0,0,0,0.15);">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}" style="display:flex;align-items:center;justify-content:center;min-width:42px;height:42px;padding:0 12px;background:transparent;border:none;border-radius:10px;color:var(--section-text);font-size:15px;font-weight:600;opacity:0.3;cursor:not-allowed;">
                        <svg style="width:14px;height:14px;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}" style="display:flex;align-items:center;justify-content:center;min-width:42px;height:42px;padding:0 12px;background:transparent;border:none;border-radius:10px;color:var(--section-text);font-size:15px;font-weight:600;text-decoration:none;transition:all 0.25s cubic-bezier(0.4, 0, 0.2, 1);">
                        <svg style="width:14px;height:14px;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li>
                        <span style="display:flex;align-items:center;justify-content:center;min-width:32px;height:42px;padding:0 12px;background:transparent;border:none;border-radius:10px;color:var(--section-text);font-size:15px;font-weight:600;pointer-events:none;">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span aria-current="page" style="display:flex;align-items:center;justify-content:center;min-width:42px;height:42px;padding:0 12px;background:linear-gradient(135deg,#f97316,#fb923c);border:none;border-radius:10px;color:white;font-size:15px;font-weight:600;box-shadow:0 4px 16px rgba(249,115,22,0.35), inset 0 1px 0 rgba(255,255,255,0.2);transform:scale(1.05);">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}" style="display:flex;align-items:center;justify-content:center;min-width:42px;height:42px;padding:0 12px;background:transparent;border:none;border-radius:10px;color:var(--section-text);font-size:15px;font-weight:600;text-decoration:none;transition:all 0.25s cubic-bezier(0.4, 0, 0.2, 1);">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}" style="display:flex;align-items:center;justify-content:center;min-width:42px;height:42px;padding:0 12px;background:transparent;border:none;border-radius:10px;color:var(--section-text);font-size:15px;font-weight:600;text-decoration:none;transition:all 0.25s cubic-bezier(0.4, 0, 0.2, 1);">
                        <svg style="width:14px;height:14px;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>
            @else
                <li>
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}" style="display:flex;align-items:center;justify-content:center;min-width:42px;height:42px;padding:0 12px;background:transparent;border:none;border-radius:10px;color:var(--section-text);font-size:15px;font-weight:600;opacity:0.3;cursor:not-allowed;">
                        <svg style="width:14px;height:14px;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </li>
            @endif
        </ul>
    </nav>

    <style>
        nav[role="navigation"] a:hover {
            background: rgba(249,115,22,0.1) !important;
            color: #f97316 !important;
            transform: translateY(-2px);
        }
        nav[role="navigation"] a:hover svg {
            color: #f97316;
        }
    </style>
@endif
