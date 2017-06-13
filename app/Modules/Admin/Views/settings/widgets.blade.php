<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('admin::settings.index')

@section('settingsContent')

<div class="row">
    <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Настройки: виджеты</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="{{ route('admin.index') }}">Главная</a>
                </li>
                <li>
                    <a href="{{ route('admin.settings.index') }}">Настройки</a>
                </li>
                <li class="active">
                    Виджеты
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->

<!-- Settings menu -->
<div class="row">
    <div class="col-xs-12 m-b-20">
        <a href="{{ route('admin.settings.index') }}" class="btn btn-default btn-rounded w-md waves-effect m-r-5">Общие настройки</a>
        <a href="{{ route('admin.settings.widgets') }}" class="btn btn-inverse btn-rounded w-md waves-effect m-r-5">Виджеты</a>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-lg-6">
        @include('admin::slider.index')
        @include('admin::reviews.index')
    </div><!-- end col -->

    <div class="col-lg-6">
        @include('admin::teamMembers.index')
        @include('admin::partners.index')
    </div><!-- end col -->
</div>

@endsection