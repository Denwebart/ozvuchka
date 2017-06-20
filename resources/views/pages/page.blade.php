<?php
/**
 * Page View
 *      (PagesController@getPage)
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
    <section class="intro intro-mini full-width jIntro bg-blog border-bottom" style="background-image: url({{ asset('frontend/images/backgrounds/pages-bg.jpg') }})" id="anchor00">
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

    <!-- PAGE CONTENT -->
    <section class="section featured-shop">
        <div class="container">
            @if($page->title)
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="voffset50"></div>
                        <h2 class="title">{{ $page->title }}</h2>
                    </div>
                </div>
            @endif
            @if($page->content)
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
            @endif
        </div>
    </section>
@endsection()