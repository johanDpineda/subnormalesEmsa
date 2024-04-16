<div>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

        <nav>
            <ul class="pagination green-background">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link" aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <button type="button" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="page-link" wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</button>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        {{-- Show the first page link --}}
                        <li class="page-item {{ ($paginator->currentPage() == 1) ? 'active' : '' }}" wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-1">
                            <button type="button" class="page-link" wire:click="gotoPage(1, '{{ $paginator->getPageName() }}')">1</button>
                        </li>

                        {{-- Show the ellipsis separator if necessary --}}
                        @if ($paginator->currentPage() > 3)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif

                        {{-- Show the middle pages --}}
                        @for ($page = max(2, $paginator->currentPage() - 1); $page <= min($paginator->lastPage() - 1, $paginator->currentPage() + 1); $page++)
                            <li class="page-item {{ ($paginator->currentPage() == $page) ? 'active' : '' }}" wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}">
                                <button type="button" class="page-link" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</button>
                            </li>
                        @endfor

                        {{-- Show the ellipsis separator if necessary --}}
                        @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif

                        {{-- Show the last page link --}}
                        <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? 'active' : '' }}" wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $paginator->lastPage() }}">
                            <button type="button" class="page-link" wire:click="gotoPage({{ $paginator->lastPage() }}, '{{ $paginator->getPageName() }}')">{{ $paginator->lastPage() }}</button>
                        </li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <button type="button" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="page-link" wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</button>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
