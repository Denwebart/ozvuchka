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
            <h4 class="page-title">Пользователи</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="#">Главная</a>
                </li>
                <li class="active">
                    Пользователи
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-sm-12 text-xs-center">
        <a href="#custom-modal" class="btn btn-inverse waves-effect waves-light m-b-20 pull-right" data-animation="fadein" data-plugin="custommodal"
           data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i> Добавить пользователя</a>
    </div><!-- end col -->
</div>
<!-- end row -->


<div class="row">
    <div id="table-container">
        @if(count($users))
            @include('admin::users._table')
        @else
            <div class="background-icon text-center">
                <p>Пользователей нет</p>
                <i class="fa fa-user-circle-o"></i>
            </div>
        @endif
    </div>
</div>
<!-- end row -->
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

        /* Deleting users :mark user as deleted */
        $('#table-container').on('click', '.button-delete', function (e) {
            var itemId = $(this).data('itemId'),
                itemTitle = $(this).data('itemTitle'),
                hasActivities = $(this).data('hasActivities');
            var text = '';
            if(hasActivities) {
                text = text + '\n Пользователь будет отмечен удаленным, активность пользователя возможно будет восстановить.';
            } else {
                text = text + '\n Пользователь будет безвозвратно удален с сайта.'
            }

            swal({
                title: "Удалить пользователя?",
                text: 'Вы точно хотите удалить пользователя '+ itemTitle +'?' + text,
                type: "error",
                showCancelButton: true,
                cancelButtonText: 'Отмена',
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'Удалить'
            }).then(function() {
                $.ajax({
                    url: "/admin/users/" + itemId,
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
                            $('[data-toggle="tooltip"]').tooltip();
                        } else {
                            notification(response.message, 'warning');
                        }
                    }
                });
            }, function(dismiss) {});
        });

        /* Deleting users :mark user as undeleted */
        $('#table-container').on('click', '.button-undelete', function (e) {
            var itemId = $(this).data('itemId');
            var itemTitle = $(this).data('itemTitle');

            swal({
                title: "Восстановить пользователя?",
                text: 'Вы точно хотите восстановить активность пользователя '+ itemTitle +'?',
                type: "success",
                showCancelButton: true,
                cancelButtonText: 'Отмена',
                confirmButtonClass: 'btn-success',
                confirmButtonText: 'Восстановить'
            }).then(function() {
                $.ajax({
                    url: "/admin/users/undelete/" + itemId,
                    dataType: "text json",
                    type: "POST",
                    data: {},
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (response) {
                        if (response.success) {
                            notification(response.message, 'success');

                            $('#table-container').html(response.resultHtml);
                            $('[data-toggle="tooltip"]').tooltip();
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