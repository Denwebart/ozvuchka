<?php
/**
 * Main Page View
 *      (PagesController@index)
 *
 * Variables:
 *      $page - object App\Models\Page
 *
 * Output slider, etc.
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('layouts.app')

@section('content')

    <!-- INTRO -->
    {!! $slider->show() !!}

    <!-- UPCOMING EVENTS -->
    <section class="section upcomming-events">
        <div class="container">
            <!--<div class="row">-->
            <!--<div class="col-md-8 col-md-offset-2">-->
            <!--<div class="voffset50"></div>-->
            <!--<div class="separator-icon">-->
            <!--<i class="fa fa-microphone"></i>-->
            <!--</div>-->
            <!--<div class="voffset30"></div>-->
            <!--<p class="pretitle">Здесь может быть какой-то текст</p>-->
            <!--<div class="voffset20"></div>-->
            <!--<h2 class="title">Услуги</h2>-->
            <!--<div class="voffset50"></div>-->
            <!--</div>-->
            <!--</div>-->
            <div class="voffset50"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="upevents">
                        <div class="upevent">
                            <div class="contain">
                                <div class="bg-image"
                                     style="background-image: url({{ asset('frontend/images/uploads/service-1.jpg') }})"></div>
                                <div class="content">
                                    <div class="voffset80"></div>
                                    <div class="separator tag"><span><i class="fa fa-microphone"></i></span></div>
                                    <div class="title">Проведение мероприятий</div>
                                    <p>торжеств, свадеб и презентаций любого уровня сложности.</p>
                                    <p class="buttons">
                                        <a href="#" class="btn rounded icon"><i class="fa fa-ticket"></i> Оставить заявку</a>
                                        <a href="#" class="btn rounded border">Подробнее</a>
                                    </p>
                                    <div class="voffset70"></div>
                                </div>
                            </div>
                        </div>
                        <div class="upevent">
                            <div class="contain">
                                <div class="bg-image"
                                     style="background-image: url({{ asset('frontend/images/uploads/service-2.jpg') }})"></div>
                                <div class="content">
                                    <div class="voffset30"></div>
                                    <div class="separator tag"><span><i class="fa fa-microphone"></i></span></div>
                                    <div class="title">Аренда оборудования</div>
                                    <p>для торжества и живой музыки.</p>
                                    <p class="buttons">
                                        <a href="#" class="btn rounded icon"><i class="fa fa-ticket"></i> Оставить заявку</a>
                                        <a href="#" class="btn rounded border">Подробнее</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="upevent">
                            <div class="contain">
                                <div class="bg-image"
                                     style="background-image: url({{ asset('frontend/images/uploads/service-3.jpg') }})"></div>
                                <div class="content">
                                    <div class="voffset80"></div>
                                    <div class="separator tag"><span><i class="fa fa-microphone"></i></span></div>
                                    <div class="title">Изготовление аудио роликов</div>
                                    <p>для радио, ТВ, супермаркетов, вокзалов, рынков и тп.</p>
                                    <p class="buttons">
                                        <a href="#" class="btn rounded icon"><i class="fa fa-ticket"></i>
                                            closed</a>
                                        <a href="#" class="btn rounded border">Подробнее</a>
                                    </p>
                                    <div class="voffset70"></div>
                                </div>
                            </div>
                        </div>
                        <div class="upevent">
                            <div class="contain">
                                <div class="bg-image"
                                     style="background-image: url({{ asset('frontend/images/uploads/service-4.jpg') }})"></div>
                                <div class="content">
                                    <div class="voffset80"></div>
                                    <div class="separator tag"><span><i class="fa fa-microphone"></i></span></div>
                                    <div class="title">Изготовление фонограмм</div>
                                    <p>для танцоров, брейкдэнс коллективов, шоубалетов, модельных показов и тп.</p>
                                    <p class="buttons">
                                        <a href="#" class="btn rounded icon"><i class="fa fa-ticket"></i> Оставить заявку</a>
                                        <a href="#" class="btn rounded border">Подробнее</a>
                                    </p>
                                    <div class="voffset70"></div>
                                </div>
                            </div>
                        </div>
                        <div class="upevent">
                            <div class="contain">
                                <div class="bg-image"
                                     style="background-image: url({{ asset('frontend/images/uploads/service-5.jpg') }})"></div>
                                <div class="content">
                                    <div class="voffset30"></div>
                                    <div class="separator tag"><span><i class="fa fa-microphone"></i></span></div>
                                    <div class="title">Подготовка фонограмм</div>
                                    <p>для корпоративов (обработка минусов, подготовка специальной музыки, фильмы).</p>
                                    <p class="buttons">
                                        <a href="#" class="btn rounded icon"><i class="fa fa-ticket"></i> Оставить заявку</a>
                                        <a href="#" class="btn rounded border">Подробнее</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="upevent">
                            <div class="contain">
                                <div class="bg-image"
                                     style="background-image: url({{ asset('frontend/images/uploads/service-6.jpg') }})"></div>
                                <div class="content">
                                    <div class="voffset30"></div>
                                    <div class="separator tag"><span><i class="fa fa-microphone"></i></span></div>
                                    <div class="title">Детская песенка для концерта</div>
                                    <p class="buttons">
                                        <a href="#" class="btn rounded icon"><i class="fa fa-ticket"></i> Оставить заявку</a>
                                        <a href="#" class="btn rounded border">Подробнее</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="voffset20"></div>
                    <p class="loadmore">
                        <a href="services.html" class="btn rounded border btn-default">Подробнее</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- LATEST NEWS -->
    <section class="section latest-news">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="voffset50"></div>
                    <div class="separator-icon">
                        <i class="fa fa-volume-up"></i>
                    </div>
                    <div class="voffset30"></div>
                    <p class="pretitle">Недавние события</p>
                    <div class="voffset20"></div>
                    <h2 class="title">Новости</h2>
                    <div class="voffset50"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-team-members js-flickity" data-flickity-options='{ "cellAlign": "left", "wrapAround": true, "contain": true, "prevNextButtons": false }'>
                        <div class="gallery-cell col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="item featured-artist">
                                <div class="image">
                                    <img src="{{ asset('frontend/images/uploads/blog-1_mini.jpg') }}" alt="">
                                </div>
                                <div class="date-sticker">
                                    <span class="day">08</span>
                                    <span class="month">апреля</span>
                                </div>
                                <div class="rollover">
                                    <div class="text">
                                        <p>
                                            Максим Киуила и Баграт Геворгян добавили
                                            красок слобожанской весне.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gallery-cell col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="item featured-artist">
                                <div class="image">
                                    <img src="{{ asset('frontend/images/uploads/blog-2_mini.jpg') }}" alt="">
                                </div>
                                <div class="date-sticker">
                                    <span class="day">30</span>
                                    <span class="month">марта</span>
                                </div>
                                <div class="rollover">
                                    <div class="text">
                                        <p>
                                            Ужин с Доменико Ди Луччио в ресторане Чехов.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gallery-cell col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="item featured-artist">
                                <div class="image">
                                    <img src="{{ asset('frontend/images/uploads/blog-3_mini.jpg') }}" alt="">
                                </div>
                                <div class="date-sticker">
                                    <span class="day">19</span>
                                    <span class="month">февраля</span>
                                </div>
                                <div class="rollover">
                                    <div class="text">
                                        <p>
                                            Благотворительный рок-концерт
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gallery-cell col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="item featured-artist">
                                <div class="image">
                                    <img src="{{ asset('frontend/images/uploads/blog-4_mini.jpg') }}" alt="">
                                </div>
                                <div class="date-sticker">
                                    <span class="day">18</span>
                                    <span class="month">октября</span>
                                    <span class="year">2016</span>
                                </div>
                                <div class="rollover">
                                    <div class="text">
                                        <p>
                                            "ГИЧ Оркестр" г.Львов. Техническое
                                            обеспечение концерта Tokarev Sound Group и OZVUCHKA.com
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gallery-cell col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="item featured-artist">
                                <div class="image">
                                    <img src="{{ asset('frontend/images/uploads/blog-5_mini.jpg') }}" alt="">
                                </div>
                                <div class="date-sticker">
                                    <span class="day">18</span>
                                    <span class="month">сентября</span>
                                    <span class="year">2016</span>
                                </div>
                                <div class="rollover">
                                    <div class="text">
                                        <p>
                                            OZVUCHKA.com на мероприятии "Секреты кухни" от FIRST LINE GROUP
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="voffset120"></div>
        </div>
    </section>

    <!-- LATEST MEDIA -->
    {!! $gallery->show() !!}

    <!-- PAGE TEXT -->
    <section class="section featured-shop">
        <div class="container">
            @if($page->title)
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="voffset50"></div>
                        <h1 class="title">{{ $page->title }}</h1>
                        <div class="voffset50"></div>
                    </div>
                </div>
            @endif
            @if($page->content)
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="page-content">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{--<h2>Слайдер</h2>--}}
    {{--{!! $slider->show() !!}--}}

    {{--{!! $reviews->show() !!}--}}

    {{--{!! $teamMembers->show() !!}--}}

    {{--{!! $gallery->show() !!}--}}
@endsection()