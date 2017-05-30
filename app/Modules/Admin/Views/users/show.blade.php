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
            <h4 class="page-title">Пользователь {{ $user->login }}</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="#">Главная</a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}">Пользователи</a>
                </li>
                <li class="active">
                    Пользователь {{ $user->login }}
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->

@endsection