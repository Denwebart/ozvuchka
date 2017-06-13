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
    <section class="intro intro-mini full-width jIntro bg-blog" style="background-image: url({{ asset('frontend/images/backgrounds/partners.jpg') }})" id="anchor00">
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

    <!-- DISCOGRAPHY -->
    <section class="section discography inverse-color" id="anchor04">
        <div id="discography"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h4 class="upcomming-events-list-title">Мы сотрудничаем</h4>
                </div>
            </div>
            <!--<div class="voffset50"></div>-->
            <div class="row">
                <div class="col-md-12">
                    <ul class="carousel-discography js-flickity" data-flickity-options='{ "cellAlign": "left", "wrapAround": true, "contain": true, "prevNextButtons": false }'>
                        <!-- col-xlg-3 -->
                        <li class="gallery-cell col-xs-12 col-sm-6 col-md-4">
                            <div class="info-album">
                                <div class="cover open-disc" data-url="discs/disc-01.html">
                                    <img src="{{ asset('frontend/images/uploads/partners-1.jpg') }}" alt="">
                                    <div class="rollover">
                                        <ul class="social">
                                            <li><a href="#"><i class="fa fa-vk"></i></a></li>
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <p>
                                                Описание, если нужно.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <p class="album">Tokarev SoundGroup</p>
                            </div>
                        </li>
                        <li class="gallery-cell col-xs-12 col-sm-6 col-md-4">
                            <div class="info-album">
                                <div class="cover open-disc" data-url="discs/disc-02.html">
                                    <img src="{{ asset('frontend/images/uploads/partners-2.jpg') }}" alt="">
                                    <div class="rollover">
                                        <ul class="social">
                                            <li><a href="#"><i class="fa fa-vk"></i></a></li>
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <p>
                                                Живая музыка для любого мероприятия.
                                                Классический джаз, новые обработки
                                                старых хитов и популярные танцевальные песни.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <p class="album">Happy Time</p>
                            </div>
                        </li>
                        <li class="gallery-cell col-xs-12 col-sm-6 col-md-4">
                            <div class="info-album">
                                <div class="cover open-disc" data-url="discs/disc-03.html">
                                    <img src="{{ asset('frontend/images/uploads/partners-3.jpg') }}" alt="">
                                    <div class="rollover">
                                        <ul class="social">
                                            <li><a href="#"><i class="fa fa-vk"></i></a></li>
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <p>
                                                Далеко-далеко за словесными горами в стране
                                                гласных и согласных живут рыбные тексты.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <p class="album">Мария Панасенко</p>
                            </div>
                        </li>
                        <li class="gallery-cell col-xs-12 col-sm-6 col-md-4">
                            <div class="info-album">
                                <div class="cover open-disc" data-url="discs/disc-04.html">
                                    <img src="{{ asset('frontend/images/uploads/partners-4.jpg') }}" alt="">
                                    <div class="rollover">
                                        <ul class="social">
                                            <li><a href="#"><i class="fa fa-vk"></i></a></li>
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <p>
                                                Далеко-далеко за словесными горами в стране
                                                гласных и согласных живут рыбные тексты.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <p class="album">Кто-то еще</p>
                            </div>
                        </li>
                    </ul>
                    <div class="voffset90"></div>
                </div>
            </div>
        </div>
        <!-- DETAILS DISCO -->
        <div id="project-show"></div>
        <div class="section player-album project-window">
            <div class="project-content"></div><!-- AJAX Dinamic Content -->
        </div>
    </section>

    <!-- PAGE TEXT -->
    @if($page->content)
        <section class="section featured-shop">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="page-content">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection()