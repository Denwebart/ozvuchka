<?php
/**
 * Category Page View
 *      (PagesController@getCategoryPage)
 *
 * Variables:
 *      $page - object App\Models\Page
 *      $pages - collection with pages object App\Models\Page
 *
 * Output child pages.
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('layouts.app')

@section('content')
    <!-- INTRO -->
    <section class="intro intro-mini full-width jIntro bg-blog" style="background-image: url({{ asset('frontend/images/backgrounds/news.jpg') }})" id="anchor00">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1 class="primary-title">{{ $page->getTitle() }}</h1>
                        {{--<h2 class="subtitle-text"></h2>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NEWS -->
    <div class="section blog list-posts" id="anchor07">
        <div class="container">
            <div class="voffset50"></div>
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar">

                        @if(count($subcategories))
                            <ul class="menu-sidebar full">
                                @foreach($subcategories as $subcategory)
                                    <li>
                                        <a href="{{ $subcategory->getUrl() }}">
                                            {{ $subcategory->getTitle() }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="voffset50"></div>
                        @endif

                        <!-- Social links -->
                        {{--@if($siteSettings[])--}}
                        <div class="title small">Мы в социальных сетях</div>
                        <ul class="social">
                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li class="instagram"><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li class="pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li class="flickr"><a href="#"><i class="fa fa-flickr"></i></a></li>
                            <li class="tumblr"><a href="#"><i class="fa fa-tumblr"></i></a></li>
                            <li class="dribbble"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li class="youtube"><a href="#"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                        {{--@endif--}}

                        <!-- Latest News -->
                        {!! $latestNews->vertical() !!}

                        <!-- Reviews -->
                        {!! $reviews->vertical() !!}

                        <div class="title small">Мы в инстаграмме</div>
                        <div class="instagram-feed">
                            <ul>
                                <li><img src="{{ asset('frontend/images/uploads/instagram1.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('frontend/images/uploads/instagram2.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('frontend/images/uploads/instagram3.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('frontend/images/uploads/instagram4.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('frontend/images/uploads/instagram5.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('frontend/images/uploads/instagram6.jpg') }}" alt=""></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    @foreach($articles as $item)
                        <article class="post-item">
                            <div class="row">
{{--                                @if($item->getPageImage())--}}
                                    <div class="col-sm-6">
                                        <a href="{{ $item->getUrl() }}">
                                            <img src="{{ $item->getPageImage(true) }}" alt="{{ $item->image_alt }}" title="{{ $item->image_alt }}" class="photo-post">
                                        </a>
                                        <p class="date-sticker">
                                            <span class="day">{{ \App\Helpers\Date::make($item->published_at, 'j') }}</span>
                                            <span class="month">{{ \App\Helpers\Date::make($item->published_at, 'M') }}</span>
                                            @if(date('Y') != \App\Helpers\Date::make($item->published_at, 'Y'))
                                                <span class="year">{{ \App\Helpers\Date::make($item->published_at, 'Y') }}</span>
                                            @endif
                                        </p>
                                    </div>
                                {{--@endif--}}
                                <div class="col-sm-6">
                                    <div class="voffset30"></div>
                                    {{--<h4 class="title small"><span>теги: </span>тег 1, тег 2</h4>--}}
                                    @if($item->title)
                                        <h2 class="title post">
                                            <a href="{{ $item->getUrl() }}">
                                                {{ $item->title }}
                                            </a>
                                        </h2>
                                    @endif
                                    @if($item->getIntrotext())
                                        <div class="introtext">
                                            {!! $item->getIntrotext() !!}
                                        </div>
                                @endif
                                <!--<span class="btn rounded close-new">view less</span>-->
                                    <a href="{{ $item->getUrl() }}" class="btn rounded">Читать далее</a>
                                    <section class="section news-window">
                                        <div class="news-content"></div><!-- AJAX Dinamic Content -->
                                    </section>
                                </div>
                            </div>
                        </article>
                    @endforeach()
                </div>
            </div>
        </div>
    </div>

    <!-- PAGINATION -->
    <section class="section paginationposts">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Предыдущая">
                                    <i class="fa fa-caret-left hidden-lg hidden-md"></i>
                                    <span aria-hidden="true" class="hidden-sm hidden-xs">Предыдущая</span>
                                </a>
                            </li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li>
                                <a href="#" aria-label="Следующая">
                                    <i class="fa fa-caret-right hidden-lg hidden-md"></i>
                                    <span aria-hidden="true" class="hidden-sm hidden-xs">Следующая</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection()