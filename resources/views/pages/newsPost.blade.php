<?php
/**
 * News Post Page View
 *      (PagesController@getNewsPostPage)
 *
 * Variables:
 *      $page - object App\Models\Page
 *
 * Output page info.
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('layouts.app')

@section('content')
    <!-- INTRO -->
    <section class="intro intro-mini full-width jIntro bg-blog" style="background-image: url({{ asset('frontend/images/backgrounds/news-bg.jpg') }})" id="anchor00">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1 class="primary-title">{{ $page->parent->getTitle() }}</h1>
                        <h2 class="subtitle-text">{{ $page->getTitle() }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- POST -->
    <div class="section blog single-post" id="anchor07">
        <div class="container">
            <div class="voffset50"></div>
            <div class="row">
                <div class="col-md-9">
                    <article class="post-details">
                        @if($page->getImageUrl())
                            <img class="featured-image" src="{{ $page->getImageUrl('full') }}" alt="{{ $page->image_url }}" title="{{ $page->image_url }}">
                        @endif
                        <h4 class="title small">
                            {{--<span class="gray">теги: </span> тег 1, тег 3--}}
                            <span class="right link-to" data-link-to="comments">
                            <i class="fa fa-commenting-o"></i>
                            <span class="comments-count">
                                Комментариев: <span class="fb-comments-count" data-href="{{ $page->getUrl() }}"></span>
                            </span>
                        </span>
                        </h4>
                        @if($page->title)
                            <h3 class="title post-detail">{{ $page->title }}</h3>
                        @endif

                        <div class="page-content">
                            {!! $page->content !!}
                        </div>

                        <!--<div class="voffset50"></div>-->
                        <!--<div class="post-author">-->
                        <!--<h4 class="title small">about the author</h4>-->
                        <!--<div class="media">-->
                        <!--<a class="pull-left" href="#">-->
                        <!--<img class="media-object" src="{ { asset('frontend/images/demo/blog/author-post.jpg') }}" alt="">-->
                        <!--</a>-->
                        <!--<div class="media-body">-->
                        <!--<h4 class="media-heading">John Doe</h4>-->
                        <!--Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante-->
                        <!--sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra-->
                        <!--turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis-->
                        <!--in faucibus.-->
                        <!--</div>-->
                        <!--</div>-->
                        <!--</div>-->

                        <div class="post-comments" id="comments">

                            <h4 class="title small">
                                <span class="comments-count">
                                    Комментариев:
                                    <span class="fb-comments-count" data-href="{{ $page->getUrl() }}"></span>
                                </span>
                            </h4>

                            <div class="voffset20"></div>

                            <div class="fb-comments" data-href="{{ $page->getUrl() }}" data-width="100%" data-numposts="10"></div>

                            {{--<!-- Comment -->--}}
                            {{--<div class="media">--}}
                                {{--<a class="pull-left" href="#">--}}
                                    {{--<img class="media-object" src="{{ asset('frontend/images/person.png') }}" alt="">--}}
                                {{--</a>--}}
                                {{--<div class="media-body">--}}
                                    {{--<h4 class="media-heading">Иван Иванов--}}
                                        {{--<small>14 апреля в 19:41</small>--}}
                                    {{--</h4>--}}
                                    {{--Вдали от всех живут они в буквенных домах на берегу--}}
                                    {{--Семантика большого языкового океана. Маленький ручеек--}}
                                    {{--Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами.--}}
                                    {{--<span class="reply">Ответить</span>--}}

                                    {{--<hr>--}}

                                    {{--<!-- Nested Comment -->--}}
                                    {{--<div class="media">--}}
                                        {{--<a class="pull-left" href="#">--}}
                                            {{--<img class="media-object" src="{{ asset('frontend/images/person.png') }}" alt="">--}}
                                        {{--</a>--}}
                                        {{--<div class="media-body">--}}
                                            {{--<h4 class="media-heading">Семён Семёныч--}}
                                                {{--<small>15 апреля в 10:13</small>--}}
                                            {{--</h4>--}}
                                            {{--Эта парадигматическая страна, в которой жаренные--}}
                                            {{--члены предложения залетают прямо в рот.--}}
                                            {{--<span class="reply">Ответить</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<!-- End Nested Comment -->--}}
                                {{--</div>--}}

                                {{--<hr>--}}

                                {{--<!-- Comment -->--}}
                                {{--<div class="media">--}}
                                    {{--<a class="pull-left" href="#">--}}
                                        {{--<img class="media-object" src="{{ asset('frontend/images/person.png') }}" alt="">--}}
                                    {{--</a>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<h4 class="media-heading">Ирина--}}
                                            {{--<small>15 апреля в 16:30</small>--}}
                                        {{--</h4>--}}
                                        {{--Даже всемогущая пунктуация не имеет власти над рыбными--}}
                                        {{--текстами, ведущими безорфографичный образ жизни.--}}
                                        {{--<span class="reply">Ответить</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>

                        {{--<div class="voffset50"></div>--}}

                        {{--<div class="post-reply">--}}
                            {{--<h4 class="title small">Оставьте комментарий</h4>--}}
                            {{--<form action="#">--}}
                                {{--<input type="text" class="form-control" placeholder="Имя:">--}}
                                {{--<input type="email" class="form-control" placeholder="Email:">--}}
                                {{--<textarea class="form-control" rows="7" placeholder="Комментарий:"></textarea>--}}
                                {{--<input type="submit" value="Отправить" class="btn rounded">--}}
                            {{--</form>--}}
                        {{--</div>--}}
                    </article>
                </div>

                <div class="col-md-3">
                    <div class="sidebar">

                        <!-- Social links -->
                        @include('parts.socialLinks')

                        <!-- VK GROUPS -->
                        @include('parts.VKgroupWidget')

                        <!-- Latest News -->
                        {!! $latestNews->vertical() !!}

                        {{--<div class="title small">Теги</div>--}}
                        {{--<div class="list-tags">--}}
                            {{--<ul>--}}
                                {{--<li><a href="#">тег 1</a></li>--}}
                                {{--<li><a href="#">тег 2</a></li>--}}
                                {{--<li><a href="#">тег 3</a></li>--}}
                                {{--<li><a href="#">какой-то тег</a></li>--}}
                                {{--<li><a href="#">что-то еще</a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}

                        <!-- Reviews -->
                        {!! $reviews->vertical() !!}

                        {{--<div class="title small">Мы в инстаграмме</div>--}}
                        {{--<div class="instagram-feed">--}}
                            {{--<ul>--}}
                                {{--<li><img src="{{ asset('frontend/images/uploads/instagram1.jpg') }}" alt=""></li>--}}
                                {{--<li><img src="{{ asset('frontend/images/uploads/instagram2.jpg') }}" alt=""></li>--}}
                                {{--<li><img src="{{ asset('frontend/images/uploads/instagram3.jpg') }}" alt=""></li>--}}
                                {{--<li><img src="{{ asset('frontend/images/uploads/instagram4.jpg') }}" alt=""></li>--}}
                                {{--<li><img src="{{ asset('frontend/images/uploads/instagram5.jpg') }}" alt=""></li>--}}
                                {{--<li><img src="{{ asset('frontend/images/uploads/instagram6.jpg') }}" alt=""></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()