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
            <h4 class="page-title">Письма</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="{{ route('admin.index') }}">Главная</a>
                </li>
                <li class="active">
                    Письма
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">

    <!-- Right Sidebar -->
    <div class="col-lg-12">
        <div class="card-box">

            @include('admin::letters._navigation')

            <div class="inbox-rightbar">

                <div class="m-t-10 m-b-20" role="toolbar">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default waves-effect" data-toggle="tooltip" title="Отметить как непрочитанные"><i class="mdi mdi-inbox font-18 vertical-middle"></i></button>
                        <button type="button" class="btn btn-default waves-effect" data-toggle="tooltip" title="Отметить как важные"><i class="mdi mdi-star font-18 vertical-middle"></i></button>
                        <button type="button" class="btn btn-default waves-effect" data-toggle="tooltip" title="Удалить в корзину"><i class="mdi mdi-delete font-18 vertical-middle"></i></button>
                    </div>
                    <div class="btn-group" data-toggle="tooltip" title="Добавить тег">
                        <button type="button" class="btn btn-default dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-label font-18 vertical-middle"></i>
                            <b class="caret m-l-5"></b>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">Добавить к тегу:</li>
                            <li><a href="javascript: void(0);">Тег 1</a></li>
                            <li><a href="javascript: void(0);">Тег 2</a></li>
                            <li><a href="javascript: void(0);">Тег 3</a></li>
                            <li><a href="javascript: void(0);">Тег 4</a></li>
                            <li><a href="javascript: void(0);">Тег 5</a></li>
                        </ul>
                    </div>
                </div>

                <div id="table-container">
                    @include('admin::letters._table')
                </div>
            </div>

            <div class="clearfix"></div>
        </div>

    </div> <!-- end Col -->

</div><!-- End row -->
@endsection

@push('styles')
<!-- Sweet Alert -->
<link href="{{ asset('backend/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('scripts')
<!-- Sweet-Alert  -->
<script src="{{ asset('backend/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
@endpush

@push('scriptsBottom')
<script type="text/javascript">
    $(document).ready(function () {

        /* Deleting letters */
        $('#table-container').on('click', '.button-delete', function (e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var itemId = $(this).data('itemId'),
                isDeleted = $(this).data('isDeleted');

            var text = '', title = '';
            if(isDeleted) {
                title = 'Удалить письмо?';
                text = 'Вы точно хотите безвозвратно удалить письмо из корзины?';
            } else {
                title = 'Переместить письмо в корзину?';
                text = 'Письмо будет помещено в корзину.';
            }

            swal({
                title: title,
                text: text,
                type: "error",
                showCancelButton: true,
                cancelButtonText: 'Отмена',
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'Удалить'
            }).then(function() {
                $.ajax({
                    url: "/admin/letters/" + itemId,
                    dataType: "text json",
                    type: "DELETE",
                    data: {'route': "{{ \Route::current()->getName() }}"},
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (response) {
                        if (response.success) {
                            notification(response.message, 'success');

                            $('#table-container').html(response.resultHtml);
                            $('[data-toggle="tooltip"]').tooltip();
                        } else {
                            notification(response.message, 'error');
                        }
                    }
                });
            }, function(dismiss) {});
        });

        /* Mark letters as important */
        $('#table-container').on('click', '.button-make-important', function (e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var $button = $(this);
                itemId = $button.data('itemId'),
                isImportant = $button.data('isImportant');

            $.ajax({
                url: "/admin/letters/change_important_status/" + itemId,
                dataType: "text json",
                type: "POST",
                data: {'is_important': isImportant, 'route': "{{ \Route::current()->getName() }}"},
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response) {
                    if (response.success) {
                        notification(response.message, 'success');

                        $('#table-container').html(response.resultHtml);
                        $('[data-toggle="tooltip"]').tooltip();
                    } else {
                        notification(response.message, 'error');
                    }
                }
            });
        });
    });
</script>
@endpush