<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@foreach($menuItems as $itemId => $item)
    @if($item->page)
        <li class="@if(\Request::is($item->page->getUrl()) || \Request::url() == url($item->page->alias)) active @endif">
            <a href="{{ $item->page->getUrl() }}">
                <span>{{ $item->page->getTitle() }}</span>
                {{-- Uncomment if need submenu --}}
                {{--@if(count($item->page->children))--}}
                    {{--<span class="caret"></span>--}}
                {{--@endif--}}
            </a>
            {{-- Uncomment if need submenu --}}
            {{--@if(count($item->page->children))--}}
                {{--<ul class="dropdown-menu" role="menu">--}}
                    {{--@foreach($item->page->children as $childItem)--}}
                        {{--<li>--}}
                            {{--<a href="{{ $childItem->getUrl() }}">--}}
                                {{--{{ $childItem->getTitle() }}--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            {{--@endif--}}
        </li>
    @endif
@endforeach