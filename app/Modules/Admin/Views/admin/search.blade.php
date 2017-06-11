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
                <h4 class="page-title">Результаты поиска</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('admin.index') }}">Главная</a>
                    </li>
                    <li class="active">
                        Результаты поиска
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form action="{{ route('admin.search') }}" method="GET" role="search">
                <div class="input-group m-t-10">
                    <input type="text" id="query" name="query" placeholder="Поиск..." class="form-control" value="{{ $searchQuery }}">
                    <span class="input-group-btn">
                        <button type="submit" class="btn waves-effect waves-light btn-custom"><i class="fa fa-search m-r-5"></i> Искать</button>
                    </span>
                </div>
            </form>
            @if($searchQuery)
                <div class="m-t-30 text-center">
                    <h4><b>Результаты поиска по запросу "{{ $searchQuery }}"</b></h4>
                </div>
            @endif
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="search-result-box m-t-30 card-box" id="table-container">
                @if(count($results))
                    <ul class="nav nav-tabs tabs-bordered">
                        <li class="active">
                            <a href="#all-results" data-toggle="tab" aria-expanded="true">
                                <b>Все результаты</b>
                                <span class="badge badge-success m-l-10">{{ count($results) }}</span>
                            </a>
                        </li>
                        @if(isset($pagesResults) && count($pagesResults))
                            <li class="">
                                <a href="#pages" data-toggle="tab" aria-expanded="false">
                                    <b>Страницы</b>
                                    <span class="badge badge-danger m-l-10">{{ count($pagesResults) }}</span>
                                </a>
                            </li>
                        @endif
                        @if(isset($galleryResults) && count($galleryResults))
                            <li class="">
                                <a href="#gallery" data-toggle="tab" aria-expanded="false">
                                    <b>Галерея</b>
                                    <span class="badge badge-danger m-l-10">{{ count($galleryResults) }}</span>
                                </a>
                            </li>
                        @endif
                        @if(isset($usersResults) && count($usersResults))
                            <li class="">
                                <a href="#users" data-toggle="tab" aria-expanded="false">
                                    <b>Пользователи</b>
                                    <span class="badge badge-danger m-l-10">{{ count($usersResults) }}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        <!-- All results tab -->
                        <div class="tab-pane active" id="all-results">
                            <div class="row">
                                <div class="col-md-12">

                                    @foreach($results as $result)
                                        @if(is_a($result, \App\Models\Page::class))
                                            {{--Page--}}
                                            @include('admin::admin._searchPage')
                                        @elseif(is_a($result, \App\Models\Gallery::class))
                                            {{-- Gallery --}}
                                            @include('admin::admin._searchGallery')
                                        @elseif(is_a($result, \App\Models\User::class))
                                            {{--User--}}
                                            @include('admin::admin._searchUser')
                                        @endif
                                    @endforeach

                                    {{--<ul class="pagination pagination-split pull-right">--}}
                                        {{--<li class="disabled">--}}
                                            {{--<a href="#"><i class="fa fa-angle-left"></i></a>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                            {{--<a href="#">1</a>--}}
                                        {{--</li>--}}
                                        {{--<li class="active">--}}
                                            {{--<a href="#">2</a>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                            {{--<a href="#">3</a>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                            {{--<a href="#">4</a>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                            {{--<a href="#">5</a>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                            {{--<a href="#"><i class="fa fa-angle-right"></i></a>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end All results tab -->

                        <!-- Pages tab -->
                        @if(isset($pagesResults) && count($pagesResults))
                            <div class="tab-pane" id="pages">

                                @foreach($pagesResults as $result)
                                    {{--Page--}}
                                    @include('admin::admin._searchPage')
                                @endforeach

                                {{--<ul class="pagination pagination-split pull-right">--}}
                                    {{--<li class="disabled">--}}
                                        {{--<a href="#"><i class="fa fa-angle-left"></i></a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">1</a>--}}
                                    {{--</li>--}}
                                    {{--<li class="active">--}}
                                        {{--<a href="#">2</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">3</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">4</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">5</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#"><i class="fa fa-angle-right"></i></a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}

                                <div class="clearfix"></div>

                            </div>
                        @endif
                        <!-- end Pages tab -->

                        <!-- Gallery tab -->
                        @if(isset($galleryResults) && count($galleryResults))
                            <div class="tab-pane" id="gallery">

                                @foreach($galleryResults as $result)
                                    {{--Gallery--}}
                                    @include('admin::admin._searchGallery')
                                @endforeach

                                {{--<ul class="pagination pagination-split pull-right">--}}
                                    {{--<li class="disabled">--}}
                                        {{--<a href="#"><i class="fa fa-angle-left"></i></a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">1</a>--}}
                                    {{--</li>--}}
                                    {{--<li class="active">--}}
                                        {{--<a href="#">2</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">3</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">4</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">5</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#"><i class="fa fa-angle-right"></i></a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}

                                <div class="clearfix"></div>

                            </div>
                        @endif
                        <!-- end Gallery tab -->

                        <!-- Users tab -->
                        @if(isset($usersResults) && count($usersResults))
                            <div class="tab-pane" id="users">

                                @foreach($usersResults as $result)
                                    {{--Users--}}
                                    @include('admin::admin._searchUser')
                                @endforeach

                                {{--<ul class="pagination pagination-split pull-right">--}}
                                    {{--<li class="disabled">--}}
                                        {{--<a href="#"><i class="fa fa-angle-left"></i></a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">1</a>--}}
                                    {{--</li>--}}
                                    {{--<li class="active">--}}
                                        {{--<a href="#">2</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">3</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">4</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">5</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#"><i class="fa fa-angle-right"></i></a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}

                                <div class="clearfix"></div>

                            </div>
                    @endif
                    <!-- end Users tab -->
                    </div>
                @else
                    <div class="background-icon text-center">
                        @if($searchQuery)
                            <p>Ничего не найдено</p>
                            <i class="fa fa-frown-o"></i>
                        @else
                            <p>Введите запрос для поиска</p>
                            <i class="fa fa-search"></i>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection