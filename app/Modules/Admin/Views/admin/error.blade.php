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
                <h4 class="page-title">{{ $page->menu_title }}</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('admin.index') }}">Главная</a>
                    </li>
                    <li class="active">
                        {{ $page->menu_title }}
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="text-center p-t-10">
                <h1 class="text-error m-t-50 p-t-10">
                    <i class="fa {{ $page->icon }}"></i>
                    {{ $page->code }}
                </h1>
                <h2 class="text-uppercase text-danger m-t-30">{{ $page->title }}</h2>
                <p class="text-muted m-t-30">{{ $page->content }}</p>

                <a class="btn btn-md btn-custom waves-effect waves-light m-t-20" href="{{ route('admin.index') }}">
                    Вернуться на главную
                </a>
            </div>

        </div><!-- end col -->
    </div>

@endsection