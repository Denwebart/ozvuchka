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
            <h4 class="page-title">Новое письмо</h4>
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
                    <span class="text-muted font-12 m-r-20">Действия с письмом: </span>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default waves-effect" data-toggle="tooltip" title="Отметить как важное"><i class="mdi mdi-star font-18 vertical-middle"></i></button>
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

                <div class="card-box m-t-20">
                    <h4 class="m-t-0"><b>{{ $letter->subject }}</b></h4>

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
                {{--<div class="text-right">--}}
                    {{--<button type="button" class="btn btn-primary waves-effect waves-light w-md m-b-30">Ответить</button>--}}
                {{--</div>--}}
            </div>

            <div class="clearfix"></div>
        </div>

    </div> <!-- end Col -->

</div><!-- End row -->
@endsection