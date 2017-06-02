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
            <h4 class="page-title">Письмо от {{ $letter->email }}</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="{{ route('admin.index') }}">Главная</a>
                </li>
                <li>
                    <a href="{{ route('admin.letters.index') }}">Письма</a>
                </li>
                <li class="active">
                    {{ $letter->subject }}
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

                <div class="m-t-10 m-b-20 text-right" role="toolbar">
                    <span class="text-muted font-12 m-r-10">Действия с письмом: </span>
                    <div class="btn-group">
                        <button type="button" class="button-make-important btn btn-default waves-effect" data-item-id="{{ $letter->id }}" data-is-important="{{ $letter->is_important }}" data-toggle="tooltip" title="@if($letter->is_important) Снять метку &#34;Важное&#34; @else Отметить как важное @endif">
                            <i class="mdi mdi-star @if($letter->is_important) text-warning @endif font-18 vertical-middle"></i>
                        </button>
                        <button type="button" class="button-delete btn btn-default waves-effect" data-item-id="{{ $letter->id }}" data-is-deleted="{{ $letter->deleted_at ? 1 : 0 }}" data-toggle="tooltip" title="@if(!$letter->deleted_at) Удалить в корзину @else Удалить из корзины @endif">
                            <i class="mdi mdi-delete font-18 vertical-middle"></i>
                        </button>
                    </div>
                    {{--<div class="btn-group" data-toggle="tooltip" title="Добавить тег">--}}
                        {{--<button type="button" class="btn btn-default dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">--}}
                            {{--<i class="mdi mdi-label font-18 vertical-middle"></i>--}}
                            {{--<b class="caret m-l-5"></b>--}}
                        {{--</button>--}}
                        {{--<ul class="dropdown-menu" role="menu">--}}
                            {{--<li class="dropdown-header">Добавить к тегу:</li>--}}
                            {{--<li><a href="javascript: void(0);">Тег 1</a></li>--}}
                            {{--<li><a href="javascript: void(0);">Тег 2</a></li>--}}
                            {{--<li><a href="javascript: void(0);">Тег 3</a></li>--}}
                            {{--<li><a href="javascript: void(0);">Тег 4</a></li>--}}
                            {{--<li><a href="javascript: void(0);">Тег 5</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                </div>

                <div class="card-box m-t-20 m-b-20">
                    <h4 class="letter-subject m-t-0">
                        <b>{{ $letter->subject }}</b>
                        <span class="pull-right">
                             <span class="date-delete text-danger font-13" @if(!$letter->deleted_at) style="display: none;" @endif>
                                Удалено
                                <span class="date">
                                    {{ \App\Helpers\Date::format($letter->deleted_at, true) }}
                                </span>
                            </span>
                            <button type="button" class="button-make-important fa fa-star text-warning" @if(!$letter->is_important) style="display: none;" @endif data-item-id="{{ $letter->id }}" data-is-important="{{ $letter->is_important }}" data-toggle="tooltip" title="Снять метку &#34;Важное&#34;"></button>
                        </span>
                    </h4>

                    <hr/>

                    <div class="media m-b-30 ">
                        <a href="#" class="pull-left">
                            <img alt="" src="/backend/images/users/avatar-2.jpg" class="media-object thumb-sm img-circle">
                        </a>
                        <div class="media-body">
                            <span class="media-meta pull-right">{{ \App\Helpers\Date::format($letter->created_at, true, true) }}</span>
                            <h4 class="text-primary m-0">{{ $letter->name }}</h4>
                            <small class="text-muted">Отправитель: {{ $letter->email }}</small>
                        </div>
                    </div> <!-- media -->

                    <p>{{ $letter->message }}</p>

                </div> <!-- card-box -->
                <div class="text-right">
                    <button type="button" class="btn btn-custom waves-effect waves-light w-md m-b-30">
                        <i class="fa fa-mail-reply"></i>
                        Ответить
                    </button>
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
        $(document).on('click', '.button-delete', function (e) {
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

                            if(response.isDeleted) {
                                $('.button-delete').data('isDeleted', response.isDeleted);
                                $('.letter-subject .date-delete').show().find('.date').text(response.deletedAt);
                                $('.button-delete').attr('data-original-title', 'Удалить из корзины');
                            } else {
                                window.location.href = "{{ \URL::previous() }}";
                            }
                        } else {
                            notification(response.message, 'error');
                        }
                    }
                });
            }, function(dismiss) {});
        });

        /* Mark letters as important */
        $(document).on('click', '.button-make-important', function (e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var $button = $(this),
                itemId = $button.data('itemId'),
                isImportant = $button.attr('data-is-important');

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

                        if(response.isImportant) {
                            $('.letter-subject .button-make-important').show();
                            $('.button-make-important').attr('data-original-title', 'Снять метку "Важное"');
                        } else {
                            $('.letter-subject .button-make-important').hide();
                            $('.button-make-important').attr('data-original-title', 'Отметить как важное')
                        }

                        $('.button-make-important').attr('data-is-important', response.isImportant)
                            .find('i').toggleClass('text-warning').toggleClass('');
                    } else {
                        notification(response.message, 'error');
                    }
                }
            });
        });
    });
</script>
@endpush