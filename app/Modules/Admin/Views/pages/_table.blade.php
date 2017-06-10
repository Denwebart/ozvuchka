<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($pages))
    <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap" cellspacing="0" width="100%" id="datatable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Тип</th>
            <th>Заголовок</th>
            <th>URL</th>
            <th>Статус публикации</th>
            <th>Мета-теги</th>
            <th class="hidden-sm">Действия</th>
        </tr>
        </thead>

        <tbody>
        @foreach($pages as $page)
            <tr class="item" data-page-id="{{ $page->id }}">
                <td>
                    <b>{{ $page->id }}</b>
                </td>

                <td>
                    @if(array_key_exists($page->id, \App\Models\Page::$pagesIcons))
                        <i class="{{ \App\Models\Page::$pagesIcons[$page->id] }}" title="Системная страница" data-toggle="tooltip"></i>
                    @elseif($page->type == \App\Models\Page::TYPE_SYSTEM_PAGE)
                        <i class="fa fa-cog" title="Системная страница" data-toggle="tooltip"></i>
                    @elseif($page->is_container)
                        <i class="fa fa-folder" title="Категория" data-toggle="tooltip"></i>
                    @else
                        <i class="fa fa-file-o" title="Страница" data-toggle="tooltip"></i>
                    @endif
                </td>

                <td>
                    {{ $page->getTitle() }}
                </td>

                <td>
                    <a href="{{ $page->getUrl() }}" target="_blank" rel="nofollow noopener">{{ $page->getUrl(true) }}</a>
                </td>

                <td class="published-status">
                <span class="label @if($page->is_published) label-success @else label-muted @endif">
                    {{ \App\Models\Page::$is_published[$page->is_published] }}
                </span>
                </td>

                <td class="meta-data">
                    @if($page->meta_title && $page->meta_desc && $page->meta_key)
                        <span class="label label-success">Заполнены</span>
                    @elseif(!$page->meta_title && !$page->meta_desc && !$page->meta_key)
                        <span class="label @if($page->is_published) label-danger @else label-muted @endif">Не заполнены</span>
                    @else
                        @if(!$page->meta_title) <span class="label @if($page->is_published) label-danger @else label-muted @endif">Нет тега Title</span>@endif
                        @if(!$page->meta_desc) <span class="label @if($page->is_published) label-danger @else label-muted @endif">Нет тега Description</span>@endif
                        @if(!$page->meta_key) <span class="label @if($page->is_published) label-warning @else label-muted @endif">Нет тега Keywords</span>@endif
                    @endif
                </td>

                <td>
                    <div class="btn-group dropdown">
                        <a href="javascript: void(0);" class="table-action-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li><a href="{{ route('admin.pages.edit', ['id' => $page->id]) }}"><i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Редактировать</a></li>
                            @if(!$page->isMain())
                                <li>
                                    <a href="#" class="button-change-published-status" data-item-id="{{ $page->id }}" data-is-published="{{ $page->is_published }}">
                                        @if($page->is_published)
                                            <i class="mdi mdi-eye-off m-r-10 text-muted font-18 vertical-middle"></i><span>Снять с публикации</span>
                                        @else
                                            <i class="mdi mdi-eye m-r-10 text-muted font-18 vertical-middle"></i><span>Опубликовать</span>
                                        @endif
                                    </a>
                                </li>
                            @endif
                            @if($page->canBeDeleted())
                                <li><a href="#" class="button-delete" data-item-id="{{ $page->id }}" data-item-title="{{ $page->getTitle() }}" data-count-children="{{ count($page->children) }}" data-count-menus="{{ count($page->menus) }}"><i class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>Удалить</a></li>
                            @endif
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class="background-icon text-center">
        <p>Страниц нет</p>
        <i class="fa fa-file-text-o"></i>
    </div>
@endif