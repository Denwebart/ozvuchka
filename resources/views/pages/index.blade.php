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

@extends('layouts.app', ['headerClass' => 'dark-header'])

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
            <div class="voffset50"></div>
        </div>
    </section>

    <!-- LATEST NEWS -->
    {!! $latestNews->horizontal(10) !!}

    <!-- LATEST MEDIA -->
    {!! $gallery->show(4) !!}

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
@endsection()