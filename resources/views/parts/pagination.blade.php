<?php
/**
 * Custom pagination for frontend
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if ($paginator->hasPages())
    <section class="section paginationposts">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <ul class="pagination">
                            @foreach ($elements as $element)
                                {{-- Previous Page Link --}}
                                @if ($paginator->onFirstPage())
                                    <li class="disabled">
                                        <i class="fa fa-caret-left hidden-lg hidden-md"></i>
                                        <span aria-hidden="true" class="hidden-sm hidden-xs">Предыдущая</span>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Предыдущая">
                                            <i class="fa fa-caret-left hidden-lg hidden-md"></i>
                                            <span aria-hidden="true" class="hidden-sm hidden-xs">Предыдущая</span>
                                        </a>
                                    </li>
                                @endif

                                {{-- "Three Dots" Separator --}}
                                @if (is_string($element))
                                    <li class="disabled"><span>{{ $element }}</span></li>
                                @endif

                                {{-- Array Of Links --}}
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $paginator->currentPage())
                                            <li class="active"><a href="{{ $url }}">{{ $page }}</a></li>
                                        @else
                                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                                @endif

                                {{-- Next Page Link --}}
                                @if ($paginator->hasMorePages())
                                    <li>
                                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Следующая">
                                            <i class="fa fa-caret-right hidden-lg hidden-md"></i>
                                            <span aria-hidden="true" class="hidden-sm hidden-xs">Следующая</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="disabled">
                                        <i class="fa fa-caret-right hidden-lg hidden-md"></i>
                                        <span aria-hidden="true" class="hidden-sm hidden-xs">Следующая</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endif