<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
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
        <a href="{{ route('admin.pages.create') }}" class="btn btn-inverse m-b-20 pull-right">
            <i class="fa fa-plus m-r-5"></i>
            Добавить страницу
        </a>
    </div>

    <div class="col-md-12">
        <div class="card-box" id="table-container">
            @if(count($pages))
                @include('admin::pages._table')
            @else
                <div class="background-icon text-center">
                    <p>Страниц нет</p>
                    <i class="fa fa-file-text-o"></i>
                </div>
            @endif
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
<!-- Sweet Alert -->
<link href="{{ asset('backend/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('scripts')
<!-- DataTables -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
<!-- Sweet-Alert  -->
<script src="{{ asset('backend/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
@endpush

@push('scriptsBottom')
<script type="text/javascript">
    $(document).ready(function () {
        /* DataTables */
        var dataTableOptions = {
            "language": {
                "url": "/backend/plugins/datatables/dataTables.russian.json"
            },
            "stateSave": true
        };
        $('#datatable').dataTable(dataTableOptions);

        /* Deleting pages */
        $('#table-container').on('click', '.button-delete', function (e) {
            var itemId = $(this).data('itemId'),
                itemTitle = $(this).data('itemTitle'),
                countChildren = $(this).data('countChildren'),
                countMenus = $(this).data('countMenus');

            var text = '';
            if(countMenus) {
                text = text + '\n Страница будет удалена из меню.';
            }
            if(countChildren) {
                text = text + '\n Все вложенные страницы (' + countChildren + ' шт.) будут удалены.';
            }

            swal({
                title: "Удалить страницу?",
                text: 'Вы точно хотите удалить страницу "'+ itemTitle +'"?' + text,
                type: "error",
                showCancelButton: true,
                cancelButtonText: 'Отмена',
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'Удалить'
            }).then(function() {
                $.ajax({
                    url: "/admin/pages/" + itemId,
                    dataType: "text json",
                    type: "DELETE",
                    data: {},
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (response) {
                        if (response.success) {
                            notification(response.message, 'success');

                            $('#table-container').html(response.resultHtml);

                            $('#datatable').dataTable(dataTableOptions);
                        } else {
                            notification(response.message, 'warning');
                        }
                    }
                });
            }, function(dismiss) {});
        });

        /* Change published status for pages */
        $('#table-container').on('click', '.button-change-published-status', function (e) {
            var $button = $(this);
                itemId = $button.data('itemId'),
                itemPublishedStatus = $button.data('isPublished');

            $.ajax({
                url: "/admin/pages/change_published_status/" + itemId,
                dataType: "text json",
                type: "POST",
                data: {'is_published': itemPublishedStatus},
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response) {
                    if (response.success) {
                        notification(response.message, 'success');
                        $button.data('isPublished', response.isPublished);
                        if(response.isPublished) {
                            $button.find('span').text('Снять с публикации');
                        } else {
                            $button.find('span').text('Опубликовать');
                        }
                        $button.find('i').toggleClass('mdi-eye-off').toggleClass('mdi-eye');
                        $('.item[data-page-id='+ itemId +']').find('.published-status .label')
                            .toggleClass('label-muted').toggleClass('label-success')
                            .text(response.isPublishedText);
                        var $metaDataLabel = $('.item[data-page-id='+ itemId +']').find('.meta-data .label');
                        if(!$metaDataLabel.hasClass('label-success')) {
                            $metaDataLabel.toggleClass('label-muted').toggleClass('label-danger').toggleClass('label-warning');
                        }
                    } else {
                        notification(response.message, 'error');
                    }
                }
            });
        });
    });
</script>
@endpush