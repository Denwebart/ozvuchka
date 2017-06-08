<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<ul class="sortable list-group">
    @foreach($items as $item)
        @if($item->page)
            <li class="item list-group-item" id="{{ $item->id }}" data-item-id="{{ $item->id }}" data-page-id="{{ $item->page->id }}" data-menu-type="{{ $menuType }}">
                <span class="icon m-r-10 pull-left">
                    @if($item->page->is_container)
                        <i class="fa fa-folder" title="Категория" data-toggle="tooltip"></i>
                    @else
                        <i class="fa fa-file-o" title="Страница" data-toggle="tooltip"></i>
                    @endif
                </span>
                <span class="title">
                    <a href="#" class="editable-menu-item" data-type="text" data-value="{{ $item->page->getTitle() }}" data-pk="{{ $item->id }}" data-page-id="{{ $item->page->id }}">{{ $item->page->getTitle() }}</a>
                </span>
                <div class="buttons pull-right">
                    <a href="{{ route('admin.pages.edit', ['id' => $item->page->id]) }}" target="_blank" class="m-r-5" title="Редактировать страницу &laquo;{{ $item->page->getTitle() }}&raquo;" data-toggle="tooltip">
                        <i class="mdi mdi-pencil"></i>
                    </a>
                    <a href="#" class="delete-item m-r-5" data-item-id="{{ $item->id }}" data-page-id="{{ $item->page->id }}" data-menu-type="{{ $menuType }}" data-item-title="{{ $item->page->getTitle() }}" data-menu-title="{{ \App\Models\Menu::$types[$menuType] }}" title="Удалить пункт меню &laquo;{{ $item->page->getTitle() }}&raquo;" data-toggle="tooltip">
                        <i class="mdi mdi-close"></i>
                    </a>
                </div>
            </li>
        @endif
    @endforeach
</ul>