@if ($paginator->hasPages())
    <nav class="tw-flex tw-items-center tw-justify-between tw-gap-2">
        <div class="tw-flex tw-items-center tw-gap-2">
            <label class="tw-text-sm tw-text-gray-600">Show:</label>
            <select 
                class="tw-form-select tw-text-sm tw-rounded-md tw-border-gray-300 tw-pr-8" 
                onchange="window.location.href = this.value"
            >
                @foreach ([10, 25, 50, 100] as $perPage)
                    <option 
                        value="{{ request()->fullUrlWithQuery(['per_page' => $perPage]) }}"
                        {{ request()->get('per_page', 10) == $perPage ? 'selected' : '' }}
                    >
                        {{ $perPage }}
                    </option>
                @endforeach
            </select>
            <span class="tw-text-sm tw-text-gray-600">entries</span>
        </div>

        <div class="tw-hidden sm:tw-flex-1 sm:tw-flex sm:tw-items-center sm:tw-justify-between">
            {{-- Pagination Info --}}
            <div>
                <p class="tw-text-sm tw-text-gray-700">
                    Showing
                    <span class="tw-font-medium">{{ $paginator->firstItem() }}</span>
                    to
                    <span class="tw-font-medium">{{ $paginator->lastItem() }}</span>
                    of
                    <span class="tw-font-medium">{{ $paginator->total() }}</span>
                    results
                </p>
            </div>

            {{-- Pagination Elements --}}
            <div>
                <nav class="tw-isolate tw-inline-flex tw-rounded-md tw-shadow-sm" aria-label="Pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span class="tw-relative tw-inline-flex tw-items-center tw-px-2 tw-py-2 tw-text-gray-400 tw-ring-1 tw-ring-inset tw-ring-gray-300 hover:tw-bg-gray-50 focus:tw-z-20 focus:tw-outline-offset-0">
                            <svg class="tw-h-5 tw-w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="tw-relative tw-inline-flex tw-items-center tw-px-2 tw-py-2 tw-text-gray-400 tw-ring-1 tw-ring-inset tw-ring-gray-300 hover:tw-bg-gray-50 focus:tw-z-20 focus:tw-outline-offset-0">
                            <svg class="tw-h-5 tw-w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span class="tw-relative tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-text-sm tw-font-semibold tw-text-gray-700 tw-ring-1 tw-ring-inset tw-ring-gray-300 focus:tw-outline-offset-0">
                                {{ $element }}
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="tw-relative tw-z-10 tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-text-sm tw-font-semibold tw-text-white tw-bg-indigo-600 focus:tw-z-20 focus-visible:tw-outline focus-visible:tw-outline-2 focus-visible:tw-outline-offset-2 focus-visible:tw-outline-indigo-600">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="tw-relative tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-text-sm tw-font-semibold tw-text-gray-900 tw-ring-1 tw-ring-inset tw-ring-gray-300 hover:tw-bg-gray-50 focus:tw-z-20 focus:tw-outline-offset-0">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="tw-relative tw-inline-flex tw-items-center tw-px-2 tw-py-2 tw-text-gray-400 tw-ring-1 tw-ring-inset tw-ring-gray-300 hover:tw-bg-gray-50 focus:tw-z-20 focus:tw-outline-offset-0">
                            <svg class="tw-h-5 tw-w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span class="tw-relative tw-inline-flex tw-items-center tw-px-2 tw-py-2 tw-text-gray-400 tw-ring-1 tw-ring-inset tw-ring-gray-300 hover:tw-bg-gray-50 focus:tw-z-20 focus:tw-outline-offset-0">
                            <svg class="tw-h-5 tw-w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @endif
                </nav>
            </div>
        </div>
    </nav>
@endif 