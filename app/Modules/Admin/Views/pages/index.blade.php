<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('admin::layout')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Страницы</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="{{ route('admin.index') }}">Главная</a>
                </li>
                <li class="active">
                    Страницы
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-sm-12 text-xs-center">
        <button class="btn btn-inverse m-b-20 pull-right">
            <i class="fa fa-plus m-r-5"></i>
            Добавить страницу
        </button>
    </div>

    <div class="col-md-12">
        <div class="card-box">

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
                        <tr>
                            <td>
                                <b>#{{ $page->id }}</b>
                            </td>

                            <td>
                                @if($page->is_container)
                                    <i class="fi-folder"></i>
                                @else
                                    <i class="fi-paper"></i>
                                @endif
                            </td>

                            <td>
                                {{ $page->getTitle() }}
                            </td>

                            <td>
                                {{ $page->getUrl(true) }}
                            </td>

                            <td>
                                @if($page->is_published)
                                    <span class="label label-success">Опубликована</span>
                                @else
                                    <span class="label label-muted">Не опубликована</span>
                                @endif
                            </td>

                            <td>
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
                                        @if($page->is_published)
                                            <li><a href="#"><i class="mdi mdi-eye-off m-r-10 text-muted font-18 vertical-middle"></i>Снять с публикации</a></li>
                                        @else
                                            <li><a href="#"><i class="mdi mdi-eye m-r-10 text-muted font-18 vertical-middle"></i>Опубликовать</a></li>
                                        @endif
                                        <li><a href="#"><i class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>Удалить</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- end col -->
</div>
<!-- end row -->

@endsection

@push('styles')
<!-- DataTables -->
<link href="{{ asset('backend/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('backend/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('backend/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@push('scripts')
<!-- DataTables -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
@endpush

@push('scriptsBottom')
<script type="text/javascript">
    /* DataTables */
    $(document).ready(function () {
        $('#datatable').dataTable({
            "language": {
                "url": "/backend/plugins/datatables/dataTables.russian.json"
            },
            "stateSave": true
        });
    });
</script>
@endpush