<?php
/**
 * Gallery Page View
 *      (PagesController@getGalleryPage)
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
    <section class="intro intro-mini full-width jIntro bg-blog border-bottom" style="background-image: url({{ asset('frontend/images/backgrounds/gallery-bg.jpg') }})" id="anchor00">
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

    <!-- PAGE TITLE AND INTROTEXT -->
    @if($page->title || $page->introtext)
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

    <!-- GALLERY -->
    <section class="section last-media" id="anchor06" style="background: url({{ asset('frontend/images/backgrounds/texture.png') }}) repeat">
        <div class="container">
            <div class="voffset50"></div>
            <!-- Filters -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="filters">
                        @php $delay = 0.5 @endphp
                        <li data-filter="*" class="is-checked wow fadeInUp" data-wow-delay="{{ $delay }}s">Все</li>
                        @foreach($galleryCategories  as $category)
                            @php $delay = $delay + 0.2 @endphp
                            <li data-filter=".tag-{{ $category->id }}" class="wow fadeInUp" data-wow-delay="{{ $delay }}s">
                                {{ $category->title }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- gallery -->
            <div class="row">
                <div class="col-md-12">
                    <div class="voffset50"></div>
                    <div class="thumbnails">
                        @foreach($galleryImages as $galleryImage)
                            @include('parts.galleryItem', ['galleryCategories' => $galleryImage->categories])
                        @endforeach
                    </div>
                    {{--<div class="voffset50"></div>--}}
                    {{--<p class="loadmore">--}}
                        {{--<a id="append" href="#" class="btn rounded border">Показать еще</a>--}}
                    {{--</p>--}}
                    {{--<div id="more-items">--}}
                        {{----}}
                    {{--</div>--}}
                    <div class="voffset70"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- PAGE CONTENT -->
    @if($page->content)
        <section class="section featured-shop">
            <div class="container">
                <div class="voffset50"></div>
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