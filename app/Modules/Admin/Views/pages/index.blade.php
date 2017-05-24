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
        <div class="card-box" id="table-container">
            @include('admin::pages._table')
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
    });
</script>
@endpush