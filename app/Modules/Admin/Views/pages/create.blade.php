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
            <h4 class="page-title">Новая страница</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="{{ route('admin.index') }}">Главная</a>
                </li>
                <li>
                    <a href="{{ route('admin.pages.index') }}">Страницы</a>
                </li>
                <li class="active">
                    Новая страница
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-sm-6 col-md-6 col-xs-12 hidden-xs">
        <p class="text-muted font-13 m-b-0">
            Автор:
            <a href="{{ route('admin.users.show', ['id' => Auth::user()->id]) }}">
                <img src="{{ Auth::user()->getAvatarUrl() }}" class="img-circle m-l-5" width="18px" alt="{{ Auth::user()->login }}">
                <span class="m-l-5">{{ Auth::user()->login }}</span>
            </a>
        </p>
    </div>
    <div class="col-sm-6 col-md-6 col-xs-12">
        <div class="button pull-right">
            <button type="button" class="btn btn-custom waves-effect waves-light m-b-10 button-save-exit">
                <i class="fa fa-arrow-left"></i>
                <span>Сохранить и выйти</span>
            </button>
            <button type="button" class="btn btn-custom waves-effect waves-light m-b-10 button-save">
                <i class="fa fa-check"></i>
                <span class="hidden-sm">Сохранить</span>
            </button>
            <a href="{{ $backUrl }}" class="btn btn-default waves-effect waves-light m-b-10 button-cancel">
                <i class="fa fa-close"></i>
                <span class="hidden-md hidden-sm">Отмена</span>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($page, ['route' => ['admin.pages.store'], 'class' => 'form-horizontal', 'id' => 'main-form', 'files' => true]) !!}

            @include('admin::pages._form')

            {!! Form::close() !!}
        </div>
    </div><!-- end col -->
</div>
<!-- end row -->

@endsection