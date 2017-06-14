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
    <section class="intro intro-mini full-width jIntro bg-blog" style="background-image: url(images/backgrounds/gallery.jpg)" id="anchor00">
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

    <!-- LATEST MEDIA -->
    <section class="section last-media inverse-color" id="anchor06">
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
                            <div class="thumbnail small @foreach($galleryImage->categories as $category) tag-{{ $category->id }} @endforeach">
                                <a href="{{ $galleryImage->getImageUrl('full') }}" class="swipebox">
                                    <img src="{{ $galleryImage->getImageUrl() }}" alt="{{ $galleryImage->image_alt }}" title="{{ $galleryImage->image_alt }}">
                                    <div class="rollover">
                                        <i class="plus"></i>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    {{--<div class="voffset50"></div>--}}
                    {{--<p class="loadmore">--}}
                        {{--<a id="append" href="#" class="btn rounded border">Показать еще</a>--}}
                    {{--</p>--}}
                    {{--<div id="more-items">--}}
                        {{----}}
                    {{--</div>--}}
                    <div class="voffset80"></div>
                </div>
            </div>
        </div>
    </section>
@endsection()