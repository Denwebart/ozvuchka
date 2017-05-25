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
                        <button type="button" class="btn btn-default waves-effect"><i class="mdi mdi-inbox font-18 vertical-middle"></i></button>
                        <button type="button" class="btn btn-default waves-effect"><i class="mdi mdi-star font-18 vertical-middle"></i></button>
                        <button type="button" class="btn btn-default waves-effect"><i class="mdi mdi-delete font-18 vertical-middle"></i></button>
                    </div>
                    <div class="btn-group">
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

                <div class="card-box p-0">
                    @if(count($letters))
                        <ul class="message-list m-b-0">
                            @foreach($letters as $letter)
                                <li @if(!$letter->read_at) class="unread" @endif>
                                    <a href="{{ route('admin.letters.show', ['id' => $letter->id]) }}">
                                        <div class="col col-1">
                                            <div class="checkbox-wrapper-mail">
                                                <input type="checkbox" id="chk1">
                                                <label for="chk1" class="toggle"></label>
                                            </div>
                                            <p class="title">{{ $letter->name }}</p>
                                            <span class="star-toggle @if($letter->is_important) fa fa-star text-warning @else fa fa-star-o @endif"></span>
                                        </div>
                                        <div class="col col-2">
                                            <div class="subject">
                                                @if(!$letter->deleted_at)
                                                    {{ $letter->subject }}
                                                @else
                                                    <del>{{ $letter->subject }}</del>
                                                @endif
                                            </div>
                                            <div class="date">
                                                {{ \App\Helpers\Date::format($letter->created_at, true, true) }}
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="background-icon text-center">
                            <p>Писем нет</p>
                            <i class="fa fa-envelope"></i>
                        </div>
                    @endif
                </div> <!-- panel body -->

                @if(count($letters))
                    <div class="row">
                        <div class="col-xs-7">
                            Показано с 1 по {{ $letters->count() }}. Всего писем: {{ $letters->total() }}.
                        </div>
                        <div class="col-xs-5">
                            <div class="pull-right">
                                {{ $letters->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="clearfix"></div>
        </div>

    </div> <!-- end Col -->

</div><!-- End row -->
@endsection