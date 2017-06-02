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
            <h4 class="page-title">Заказанные звонки</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="{{ route('admin.index') }}">Главная</a>
                </li>
                <li class="active">
                    Заказанные звонки
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div id="table-container">
                @if(count($calls))
                    @include('admin::requestedCalls._table')
                @else
                    <div class="background-icon text-center">
                        <p>Заказанных звонков нет</p>
                        <i class="fa fa-phone"></i>
                    </div>
                @endif
            </div>
        </div>
    </div><!-- end col -->
</div>
<!-- end row -->

<!-- Responsive modal for editing requestd calls -->
<div id="editing-call-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Редактирование информации о заказанном звонке</h4>
            </div>
            <div class="ajax-modal-content"></div>
            <div class="sk-circle loader">
                <div class="sk-circle1 sk-child"></div>
                <div class="sk-circle2 sk-child"></div>
                <div class="sk-circle3 sk-child"></div>
                <div class="sk-circle4 sk-child"></div>
                <div class="sk-circle5 sk-child"></div>
                <div class="sk-circle6 sk-child"></div>
                <div class="sk-circle7 sk-child"></div>
                <div class="sk-circle8 sk-child"></div>
                <div class="sk-circle9 sk-child"></div>
                <div class="sk-circle10 sk-child"></div>
                <div class="sk-circle11 sk-child"></div>
                <div class="sk-circle12 sk-child"></div>
            </div>
        </div>
    </div>
</div><!-- /.modal -->

@endsection

@push('styles')
<!-- DataTables -->
<link href="{{ asset('backend/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('backend/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('backend/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- Sweet Alert -->
<link href="{{ asset('backend/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<!-- Modal container - Custom box css -->
<link href="{{ asset('backend/plugins/custombox/css/custombox.min.css') }}" rel="stylesheet">
<!-- Spinkit css -->
<link href="{{ asset('backend/plugins/spinkit/spinkit.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
<!-- DataTables -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
<!-- Sweet-Alert  -->
<script src="{{ asset('backend/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<!-- Modal container - Modal-Effect -->
<script src="{{ asset('backend/plugins/custombox/js/custombox.min.js') }}"></script>
<script src="{{ asset('backend/plugins/custombox/js/custombox.legacy.min.js') }}"></script>
@endpush

@push('scriptsBottom')
<script type="text/javascript">
    $(document).ready(function () {
        /* DataTables */
        var dataTableOptions = {
            "language": {
                "url": "/backend/plugins/datatables/dataTables.russian.json"
            },
            "stateSave": true,
//            "stateDuration": 1,
            "order": [[ 4, "desc" ]]
        };
        $('#datatable').dataTable(dataTableOptions);

        /* Deleting requested calls */
        $('#table-container').on('click', '.button-delete', function (e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var itemId = $(this).data('itemId');

            swal({
                title: "Удалить звонок?",
                text: 'Вы точно хотите удалить заказанный звонок ?',
                type: "error",
                showCancelButton: true,
                cancelButtonText: 'Отмена',
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'Удалить'
            }).then(function() {
                $.ajax({
                    url: "/admin/calls/" + itemId,
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
                            notification(response.message, 'error');
                        }
                    }
                });
            }, function(dismiss) {});
        });

        /* Editing requested calls: open popup form */
        $('#table-container').on('click', '.button-edit', function (e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var itemId = $(this).data('itemId');

            $.ajax({
                url: "/admin/calls/" + itemId + "/edit",
                dataType: "text json",
                type: "GET",
                data: {},
                beforeSend: function (request) {
                    $('#editing-call-modal .ajax-modal-content').hide();
                    $('#editing-call-modal .loader').show();
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response) {
                    if (response.success) {
                        $('#editing-call-modal .ajax-modal-content').show().html(response.resultHtml);
                        $('#editing-call-modal .loader').hide();
                    } else {
                        $('#editing-call-modal .ajax-modal-content').show().html('<div class="modal-body">' + response.message+ '</div>');
                    }
                }
            });
        });

        /* Editing requested calls: update */
        $('#editing-call-modal').on('click', '.button-update', function(e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var $form = $('#editing-call-form'),
                formData = $form.serializeArray(),
                url = $form.attr('action');

            $.ajax({
                url: url,
                dataType: "text json",
                type: "POST",
                headers: {"X-HTTP-Method-Override": "PUT"},
                data: formData,
                beforeSend: function (request) {
                    $('#editing-call-modal .ajax-modal-content').hide();
                    $('#editing-call-modal .loader').show();
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response) {
                    if (response.success) {
                        $('#editing-call-modal').find('.close').trigger('click');
                        $('#editing-call-modal .ajax-modal-content').hide();

                        notification(response.message, 'success');

                        $('#table-container').html(response.resultHtml);
                        $('#datatable').dataTable(dataTableOptions);
                        $('[data-toggle="tooltip"]').tooltip();
                    } else {
                        $('#editing-call-modal .loader').hide();
                        $('#editing-call-modal .ajax-modal-content').show();
                        $.each(response.errors, function(index, value) {
                            var errorDiv = '.' + index + '_error';
                            $form.find(errorDiv).parent().addClass('has-error');
                            $form.find(errorDiv).show().find('strong').text(value);
                        });

                        notification(response.message, 'error');
                    }
                }
            });
        });
    });
</script>
@endpush