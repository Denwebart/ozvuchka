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
    @foreach($users as $user)
        <div class="col-md-4">
            <div class="card-box">
                <div class="member-card-alt">
                    <div class="thumb-xl member-thumb m-b-10 pull-left">
                        <img src="{{ Auth::user()->getAvatarUrl() }}" class="img-thumbnail" alt="profile-image">
                    </div>

                    <div class="member-card-alt-info">
                        <h4 class="m-b-5 m-t-0">{{ $user->login }}</h4>
                        @if($user->getFullName())
                            <p class="text-muted">{{ $user->getFullName() }}</p>
                        @endif
                        <p>
                            <span class="label @if($user->role == \App\Models\User::ROLE_ADMIN) label-success @elseif($user->role == \App\Models\User::ROLE_MODERATOR) label-info @else label-muted @endif m-b-10">
                                {{ \App\Models\User::$roles[$user->role] }}
                            </span>
                        </p>
                        <p class="text-muted">
                            <span> <a href="#" class="text-custom">{{ $user->email }}</a> </span>
                        </p>
                        <p class="text-muted font-13">
                             {{ $user->description }}
                        </p>

                        <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="btn btn-primary btn-sm m-t-15 waves-effect waves-light"> Редактировать </a>
                        <button type="button" class="btn btn-link text-danger btn-sm m-t-15 waves-effect waves-light"> Удалить </button>
                    </div>

                </div>

            </div>

        </div> <!-- end col -->
    @endforeach
</div>
    <!-- end row -->

@endsection