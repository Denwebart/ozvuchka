<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<ul class="form-editable sortable todo list-group user-list">
    @foreach($items as $item)
        <li class="list-group-item" id="{{ $item->id }}" data-item-id="{{ $item->id }}" data-page-id="{{ $item->page->id }}" data-menu-type="{{ $menuType }}">
            <span class="icon pull-left m-r-10">
                @if($item->page->type == \App\Models\Page::TYPE_PAGE && $item->page->is_container)
                    <i class="fa fa-folder" title="Категория" data-toggle="tooltip"></i>
                @else
                    <i class="fa fa-file-o" title="Страница" data-toggle="tooltip"></i>
                @endif
            </span>
            <span class="title pull-left">
                <a href="#" class="editable-menu-item" data-value="{{ $item->page->getTitle() }}" data-type="text" data-pk="{{ $item->id }}" data-page-id="{{ $item->page->id }}">{{ $item->page->getTitle() }}</a>
            </span>
            <a href="#" class="delete-item pull-right margin-right-5" data-item-id="{{ $item->id }}" data-page-id="{{ $item->page->id }}" data-menu-type="{{ $menuType }}" data-item-title="{{ $item->page->getTitle() }}" data-menu-title="{{ \App\Models\Menu::$types[$menuType] }}" title="Удалить пункт меню &laquo;{{ $item->page->getTitle() }}&raquo;" data-toggle="tooltip">
                <i class="fa fa-remove"></i>
            </a>
            <div class="clearfix"></div>
            @if(count($item->children))
                <ul class="sortable-sublist sublist margin-top-10">
                    @foreach($item->children as $itemChild)
                        <li class="list-group-item" id="{{ $itemChild->id }}" data-item-id="{{ $itemChild->id }}" data-page-id="{{ $itemChild->page->id }}" data-menu-type="{{ $menuType }}">
                            <span class="title pull-left">
                                <a href="#" class="editable-menu-item" data-value="{{ $itemChild->page->getTitle() }}" data-type="text" data-pk="{{ $itemChild->id }}" data-page-id="{{ $itemChild->page->id }}">{{ $itemChild->page->getTitle() }}</a>
                            </span>
                            <a href="#" class="delete-item pull-right margin-right-5" data-item-id="{{ $itemChild->id }}" data-page-id="{{ $itemChild->page->id }}" data-menu-type="{{ $menuType }}" data-item-title="{{ $itemChild->page->getTitle() }}" data-menu-title="{{ \App\Models\Menu::$types[$menuType] }}" title="Удалить пункт меню &laquo;{{ $itemChild->page->getTitle() }}&raquo;" data-toggle="tooltip">
                                <i class="fa fa-remove"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>