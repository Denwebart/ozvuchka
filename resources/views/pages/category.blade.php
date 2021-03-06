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
    <section class="intro intro-mini full-width jIntro bg-blog border-bottom" style="background-image: url({{ asset('frontend/images/backgrounds/category-bg.jpg') }})" id="anchor00">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        @if($page->parent)
                            <h1 class="primary-title">{{ $page->parent->getTitle() }}</h1>
                            <h2 class="subtitle-text">{{ $page->getTitle() }}</h2>
                        @else
                            <h1 class="primary-title">{{ $page->getTitle() }}</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(!$page->parent || ($page->parent && $page->parent->type != \App\Models\Page::TYPE_SYSTEM_PAGE))
        @if(count($articles))
            <!-- POSTS -->
            <div class="section blog list-posts" id="anchor07">
                <div class="container">
                    <div class="voffset50"></div>
                    <div class="row">
                        <div class="col-md-9">
                            <!-- PAGE TITLE AND INTROTEXT -->
                            @if($page->title || $page->introtext)
                                @if($page->title)
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2">
                                            <h2 class="title">{{ $page->title }}</h2>
                                            <div class="voffset50"></div>
                                        </div>
                                    </div>
                                @endif
                                @if($page->introtext)
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <div class="page-content">
                                                {!! $page->introtext !!}
                                            </div>
                                            <div class="voffset50"></div>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <div id="pagination-content">
                                @foreach($articles as $item)
                                    <article class="post-item">
                                        <div class="row">
                                            {{-- @if($item->getPageImage())--}}
                                            <div class="col-sm-6">
                                                <a href="{{ $item->getUrl() }}">
                                                    <img src="{{ $item->getPageImage(true, 'full') }}" alt="{{ $item->image_alt }}" title="{{ $item->image_alt }}" class="photo-post">
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
                                @include('parts.socialLinks')

                                <!-- VK GROUPS -->
                                @include('parts.VKgroupWidget')

                                <!-- Latest News -->
                                {!! $latestNews->vertical() !!}

                                <!-- Reviews -->
                                {!! $reviews->vertical() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PAGINATION -->
            {!! $articles->links('parts.pagination') !!}
        @endif
    @endif

    <!-- PAGE CONTENT -->
    @if($page->content)
        <section class="section featured-shop">
            <div class="container">
                <div class="row">
                    <div class="voffset50"></div>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="page-content">
                            @if($page->getImageUrl())
                                <img src="{{ $page->getImageUrl('full') }}" alt="{{ $page->image_alt }}" title="{{ $page->image_alt }}" class=page-image>
                            @endif
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection()