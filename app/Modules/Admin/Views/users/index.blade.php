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
        {{--<a href="#" class="button-create-user btn btn-inverse waves-effect waves-light m-b-20 pull-right" data-url="{{ route('admin.users.create') }}" data-toggle="modal" data-target="#users-modal" data-modal-id="users-modal" data-animation="fadein" data-overlaySpeed="200" data-overlayColor="#36404a">--}}
            {{--<i class="md md-add"></i>--}}
            {{--Добавить пользователя--}}
        {{--</a>--}}
    </div><!-- end col -->
</div>
<!-- end row -->


<div class="row">
    <div id="table-container">
        @include('admin::users._table')
    </div>
</div>
<!-- end row -->

<!-- Responsive modal for creating and editing users -->
<div id="users-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Редактирование информации о пользователе</h4>
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
<!-- Sweet Alert -->
<link href="{{ asset('backend/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<!-- Modal container - Custom box css -->
<link href="{{ asset('backend/plugins/custombox/css/custombox.min.css') }}" rel="stylesheet">
<!-- Loader - Spinkit css -->
<link href="{{ asset('backend/plugins/spinkit/spinkit.css') }}" rel="stylesheet" />
<!-- File Upload - Dropify -->
<link href="{{ asset('backend/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Switchery -->
<link rel="stylesheet" href="{{ asset('backend/plugins/switchery/switchery.min.css') }}">
<!-- Tags Input -->
<link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" />
@endpush

@push('scripts')
<!-- Sweet-Alert  -->
<script src="{{ asset('backend/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<!-- Modal container - Modal-Effect -->
<script src="{{ asset('backend/plugins/custombox/js/custombox.min.js') }}"></script>
<script src="{{ asset('backend/plugins/custombox/js/custombox.legacy.min.js') }}"></script>
<!-- Bootstrap MaxLength -->
<script src="{{ asset('backend/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<!-- File Upload - Dropify -->
<script src="{{ asset('backend/plugins/dropify/js/dropify.min.js') }}"></script>
<!-- Switchery -->
<script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>
<!-- For Sortable -->
<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Tags Input -->
<script src="{{ asset('backend/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}"></script>
@endpush

@push('scriptsBottom')
<script type="text/javascript">
    $(document).ready(function () {

        // Init plugins after ajax
        function initPluginsAfterAjax() {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();
        };

        // Creating/editing users: open popup form
        $(document).on('click', '.button-create-user, .button-edit', function (e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var itemId = $(this).data('itemId'),
                url = $(this).data('url') ? $(this).data('url') : "/admin/users/" + itemId + "/edit";

            if($(this).hasClass('button-create-user')) {
                $('#users-modal .modal-title').text('Создание нового пользователя');
            } else {
                $('#users-modal .modal-title').text('Редактирование информации о пользователе');
            }

            $.ajax({
                url: url,
                dataType: "text json",
                type: "GET",
                data: {},
                beforeSend: function (request) {
                    $('#users-modal .ajax-modal-content').hide();
                    $('#users-modal .loader').show();
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response) {
                    if (response.success) {
                        $('#users-modal .ajax-modal-content').show().html(response.resultHtml);
                        $('#users-modal .loader').hide();
                        // Bootstrap MaxLength
                        $(".maxlength").maxlength({
                            alwaysShow: true
                        });
                        var dropify = $('.dropify').dropify(dropifyOptions);
                        $('#users-modal').find('[data-plugin="switchery"]').each(function (i, o) {
                            new Switchery($(this)[0], $(this).data())
                        });
                        $('[data-toggle="tooltip"]').tooltip();
                        $('[data-toggle="popover"]').popover();
                    } else {
                        var html = '<div class="modal-body">' + response.message + '</div>';
                        $('#users-modal .ajax-modal-content').show().html(html);
                        $('#users-modal .loader').hide();

                        notification(response.message, 'error');
                    }
                }
            });
        });

        // Creating/editing users: ajax request
        $('#users-modal').on('click', '.button-save', function(e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var $form = $('#users-form'),
                formData = new FormData(),
                params   = $form.serializeArray(),
                image    = $form.find('[name="avatar"]')[0].files[0],
                url = $form.attr('action'),
                method = $form.attr('method');

            $.each(params, function(i, val) {
                formData.append(val.name, val.value);
            });
            if(image) {
                formData.append('avatar', image);
            }

            $.ajax({
                url: url,
                data: formData,
                type: "POST",
//                headers: {"X-HTTP-Method-Override": "PUT"},
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function (request) {
                    $form.find('.error').hide().find('strong').text('');
                    $form.find('.has-error').removeClass('has-error');
                    $('#users-modal .ajax-modal-content').hide();
                    $('#users-modal .loader').show();
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response) {
                    if (response.success) {
                        $('#users-modal').find('.close').trigger('click');
                        $('#users-modal .ajax-modal-content').hide();

                        notification(response.message, 'success');

                        $('#table-container').html(response.resultHtml);

                        initPluginsAfterAjax();
                    } else {
                        $('#users-modal .loader').hide();
                        $('#users-modal .ajax-modal-content').show();
                        $.each(response.errors, function(index, value) {
                            var errorDiv = '.' + index + '_error';
                            $form.find(errorDiv).parent().addClass('has-error');
                            $.each(value, function(index, value) {
                                $form.find(errorDiv).show().find('strong').append(value + '<br>');
                            });
                        });

                        notification(response.message, 'error');
                    }
                }
            });
        });

        // Change active status or boolean value
        $(document).on('change', '.ajax-checkbox', function (e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var value = 0;
            if($(this).is(':checked')) {
                value = 1;
            }
            var url = $(this).data('url') ? $(this).data('url') : "{{ route('admin.gallery.setIsActive') }}";
            $.ajax({
                url: url,
                dataType: "text json",
                type: "POST",
                data: {id: $(this).data('id'), value: value, name: $(this).attr('name')},
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    if(response.success){
                        notification(response.message, 'success');
                    } else {
                        notification(response.message, 'error');
                    }
                }
            });
        });

        /* Deleting users :mark user as deleted */
        $('#table-container').on('click', '.button-delete', function (e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

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
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var itemId = $(this).data('itemId'),
                itemTitle = $(this).data('itemTitle');

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

                            initPluginsAfterAjax();
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
