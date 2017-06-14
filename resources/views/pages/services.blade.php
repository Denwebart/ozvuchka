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
    <section class="intro intro-mini full-width jIntro bg-blog" style="background-image: url({{ asset('frontend/images/backgrounds/services.jpg') }})" id="anchor00">
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

    <!-- UPCOMMING EVENTS -->
    <section class="section full-width upcomming-events-list inverse-color">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h4 class="upcomming-events-list-title">Мы предлагаем</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li>
                            <div>
                                <p class="date-event">
                                    <img src="{{ asset('frontend/images/uploads/service-1_mini.jpg') }}" alt="">
                                </p>
                                <p class="name">
                                    <span>Проведение мероприятий</span>
                                    торжеств, свадеб, презентаций любого уровня сложности.
                                </p>
                                <p class="price">
                                    цена от
                                    <span>$199</span>
                                </p>
                                <p class="buy">
                                    <a href="#" class="btn rounded icon"><i class="fa fa-ticket"></i> оставить заявку</a>
                                </p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <p class="date-event">
                                    <img src="{{ asset('frontend/images/uploads/service-2_mini.jpg') }}" alt="">
                                </p>
                                <p class="name">
                                    <span>Аренда оборудования</span>
                                    для торжества и живой музыки.
                                </p>
                                <p class="price">
                                    цена от
                                    <span>$199</span>
                                </p>
                                <p class="buy">
                                    <a href="#" class="btn rounded icon"><i class="fa fa-ticket"></i> оставить заявку</a>
                                </p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <p class="date-event">
                                    <img src="{{ asset('frontend/images/uploads/service-3_mini.jpg') }}" alt="">
                                </p>
                                <p class="name">
                                    <span>Изготовление аудио роликов</span>
                                    для радио, ТВ, супермаркетов, вокзалов, рынков и тп.
                                </p>
                                <p class="price">
                                    цена от
                                    <span>$199</span>
                                </p>
                                <p class="buy">
                                    <a href="#" class="btn rounded icon"><i class="fa fa-ticket"></i> оставить заявку</a>
                                </p>
                            </div>
                        </li>

                        <li>
                            <div>
                                <p class="date-event">
                                    <img src="{{ asset('frontend/images/uploads/service-4_mini.jpg') }}" alt="">
                                </p>
                                <p class="name">
                                    <span>Изготовление фонограмм</span>
                                    для танцоров, брейкдэнс коллективов, шоубалетов, модельных показов и тп.
                                </p>
                                <p class="price">
                                    цена от
                                    <span>$199</span>
                                </p>
                                <p class="buy">
                                    <a href="#" class="btn rounded icon"><i class="fa fa-ticket"></i> оставить заявку</a>
                                </p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <p class="date-event">
                                    <img src="{{ asset('frontend/images/uploads/service-5_mini.jpg') }}" alt="">
                                </p>
                                <p class="name">
                                    <span>Подготовка фонограмм для корпоративов</span>
                                    (обработка минусов, подготовка специальной музыки, фильмы).
                                </p>
                                <p class="price">
                                    цена от
                                    <span>$199</span>
                                </p>
                                <p class="buy">
                                    <a href="#" class="btn rounded icon"><i class="fa fa-ticket"></i> оставить заявку</a>
                                </p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <p class="date-event">
                                    <img src="{{ asset('frontend/images/uploads/service-6_mini.jpg') }}" alt="">
                                </p>
                                <p class="name">
                                    <span>Детская песенка для концерта</span>
                                    ...
                                </p>
                                <p class="price">
                                    цена от
                                    <span>$199</span>
                                </p>
                                <p class="buy">
                                    <a href="#" class="btn rounded icon"><i class="fa fa-ticket"></i> оставить заявку</a>
                                </p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <p class="date-event">
                                    <img src="{{ asset('frontend/images/uploads/service-7_mini.jpg') }}" alt="">
                                </p>
                                <p class="name">
                                    <span>Другая творческая работа со звуком</span>
                                    ...
                                </p>
                                <p class="price">
                                    цена от
                                    <span>$199</span>
                                </p>
                                <p class="buy">
                                    <a href="#" class="btn rounded icon"><i class="fa fa-ticket"></i> оставить заявку</a>
                                </p>
                            </div>
                        </li>
                    </ul>
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
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection()