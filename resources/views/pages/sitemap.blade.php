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
    <section class="intro intro-mini full-width jIntro bg-blog" style="background-image: url({{ asset('frontend/images/backgrounds/equipment.jpg') }})" id="anchor00">
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

    <!-- PAGE TEXT -->
    <section class="section featured-shop">
        <div class="container">
            @if($page->title)
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="voffset50"></div>
                        <h2 class="title">{{ $page->title }}</h2>
                        <div class="voffset50"></div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    @if($page->introtext)
                        <div class="page-content">
                            {!! $page->introtext !!}
                        </div>
                    @endif
                    <div id="sitemap">
                        <ul>
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
                    @if($page->content)
                        <div class="page-content">
                            {!! $page->content !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection()