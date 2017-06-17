<?php
/**
 * HTML Sitemap View
 *      (PagesController@getSitemapPage)
 *
 * Variables:
 *      $page - object App\Models\Page
 *      $sitemapItems - array with public pages (object App\Models\Page)
 *
 * Output tree with site pages.
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('layouts.app')

@section('content')
    <!-- INTRO -->
    <section class="intro intro-mini full-width jIntro bg-blog border-bottom" style="background-image: url({{ asset('frontend/images/backgrounds/sitemap-bg.jpg') }})" id="anchor00">
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

    <div class="voffset50"></div>

    <!-- PAGE TITLE AND INTROTEXT -->
    @if($page->title || $page->introtext)
        <section class="section featured-shop">
            <div class="container">
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
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif

    <!-- SITEMAP -->
    <section class="section featured-shop">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3">
                    <div id="sitemap">
                        <ul class="tree">
                            @foreach($sitemapItems as $item)
                                <li>
                                    <a href="{{ $item->getUrl() }}">
                                        <span>{{ $item->getTitle() }}</span>
                                    </a>
                                    {{ \App\Helpers\View::getChildrenPages($item, $item->getUrl()) }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PAGE CONTENT -->
    @if($page->content)
        <section class="section featured-shop">
            <div class="container">
                <div class="row">
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