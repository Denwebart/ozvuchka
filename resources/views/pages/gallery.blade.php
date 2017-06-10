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
                        <li data-filter="*" class="is-checked wow fadeInUp" data-wow-delay="0.5s">Все</li>
                        <li data-filter=".music" class="wow fadeInUp" data-wow-delay="0.8s">Музыка</li>
                        <li data-filter=".concert" class="wow fadeInUp" data-wow-delay="1s">Концерты</li>
                        <!--<li data-filter=".video" class="wow fadeInUp" data-wow-delay="1.2s">Видео</li>-->
                        <li data-filter=".dj" class="wow fadeInUp" data-wow-delay="1.4s">Dj</li>
                        <li data-filter=".events" class="wow fadeInUp" data-wow-delay="1.6s">События</li>
                        <li data-filter=".party" class="wow fadeInUp" data-wow-delay="1.8s">Что-то еще</li>
                    </ul>
                </div>
            </div>
            <!-- gallery -->
            <div class="row">
                <div class="col-md-12">
                    <div class="voffset50"></div>
                    <div class="thumbnails">
                        @foreach($galleryImages as $galleryImage)
                            <div class="thumbnail small gallery-images-categories">
                                <a href="{{ $galleryImage->getImageUrl() }}" class="swipebox">
                                    <img src="{{ $galleryImage->getImageUrl() }}" alt="{{ $galleryImage->image_alt }}" title="{{ $galleryImage->image_alt }}">
                                    <div class="rollover">
                                        <i class="plus"></i>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="voffset50"></div>
                    <p class="loadmore">
                        <a id="append" href="#" class="btn rounded border">Показать еще</a>
                    </p>
                    <div id="more-items">
                        <div class="thumbnail small music">
                            <a href="{{ asset('frontend/images/uploads/gallery-2.jpg') }}" class="swipebox">
                                <img src="{{ asset('frontend/images/uploads/gallery-2.jpg') }}" alt="">
                                <div class="rollover">
                                    <i class="plus"></i>
                                </div>
                            </a>
                        </div>
                        <div class="thumbnail small dj">
                            <a href="{{ asset('frontend/images/uploads/gallery-3.jpg') }}" class="swipebox">
                                <img src="{{ asset('frontend/images/uploads/gallery-3.jpg') }}" alt="">
                                <div class="rollover">
                                    <i class="plus"></i>
                                </div>
                            </a>
                        </div>
                        <div class="thumbnail small concert">
                            <a href="{{ asset('frontend/images/uploads/gallery-4.jpg') }}" class="swipebox">
                                <img src="{{ asset('frontend/images/uploads/gallery-4.jpg') }}" alt="">
                                <div class="rollover">
                                    <i class="plus"></i>
                                </div>
                            </a>
                        </div>
                        <div class="thumbnail small events">
                            <a href="{{ asset('frontend/images/uploads/gallery-5.jpg') }}" class="swipebox">
                                <img src="{{ asset('frontend/images/uploads/gallery-5.jpg') }}" alt="">
                                <div class="rollover">
                                    <i class="plus"></i>
                                </div>
                            </a>
                        </div>
                        <div class="thumbnail small music">
                            <a href="{{ asset('frontend/images/uploads/gallery-2.jpg') }}" class="swipebox">
                                <img src="{{ asset('frontend/images/uploads/gallery-2.jpg') }}" alt="">
                                <div class="rollover">
                                    <i class="plus"></i>
                                </div>
                            </a>
                        </div>
                        <div class="thumbnail small party">
                            <a href="{{ asset('frontend/images/uploads/gallery-6.jpg') }}" class="swipebox">
                                <img src="{{ asset('frontend/images/uploads/gallery-6.jpg') }}" alt="">
                                <div class="rollover">
                                    <i class="plus"></i>
                                </div>
                            </a>
                        </div>
                        <div class="thumbnail small events">
                            <a href="{{ asset('frontend/images/uploads/gallery-7.jpg') }}" class="swipebox">
                                <img src="{{ asset('frontend/images/uploads/gallery-7.jpg') }}" alt="">
                                <div class="rollover">
                                    <i class="plus"></i>
                                </div>
                            </a>
                        </div>
                        <div class="thumbnail small music">
                            <a href="{{ asset('frontend/images/uploads/gallery-8.jpg') }}" class="swipebox">
                                <img src="{{ asset('frontend/images/uploads/gallery-8.jpg') }}" alt="">
                                <div class="rollover">
                                    <i class="plus"></i>
                                </div>
                            </a>
                        </div>
                        <div class="thumbnail small dj">
                            <a href="{{ asset('frontend/images/uploads/gallery-1.jpg') }}" class="swipebox">
                                <img src="{{ asset('frontend/images/uploads/gallery-1.jpg') }}" alt="">
                                <div class="rollover">
                                    <i class="plus"></i>
                                </div>
                            </a>
                        </div>
                        <div class="thumbnail small music concert">
                            <a href="{{ asset('frontend/images/uploads/gallery-9.jpg') }}" class="swipebox">
                                <img src="{{ asset('frontend/images/uploads/gallery-9.jpg') }}" alt="">
                                <div class="rollover">
                                    <i class="plus"></i>
                                </div>
                            </a>
                        </div>
                        <div class="thumbnail small music concert">
                            <a href="{{ asset('frontend/images/uploads/gallery-10.jpg') }}" class="swipebox">
                                <img src="{{ asset('frontend/images/uploads/gallery-10.jpg') }}" alt="">
                                <div class="rollover">
                                    <i class="plus"></i>
                                </div>
                            </a>
                        </div>
                        <div class="thumbnail small music concert">
                            <a href="{{ asset('frontend/images/uploads/gallery-11.jpg') }}" class="swipebox">
                                <img src="{{ asset('frontend/images/uploads/gallery-11.jpg') }}" alt="">
                                <div class="rollover">
                                    <i class="plus"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="voffset80"></div>
                </div>
            </div>
        </div>
    </section>
@endsection()