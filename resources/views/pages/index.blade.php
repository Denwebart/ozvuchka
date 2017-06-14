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

    <!-- SLIDER -->
    {!! $slider->show() !!}

    <!-- SERVICES -->
    @if(count($services))
        <section class="section upcomming-events">
            <div class="container">
                <div class="voffset50"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="upevents">
                            @foreach($services as $service)
                                <div class="upevent">
                                    <div class="contain">
                                        <div class="bg-image" style="background-image: url({{ $service->getPageImage() }})"></div>
                                        <div class="content">
                                            <div class="voffset80"></div>
                                            <div class="separator tag"><span><i class="fa fa-microphone"></i></span></div>
                                            <div class="title">{{ $service->getTitle() }}</div>
                                            @if($service->introtext)
                                                <div>
                                                    {!! $service->introtext !!}
                                                </div>
                                            @endif
                                            <p class="buttons">
                                                <a href="#" class="btn rounded icon"><i class="fa fa-ticket"></i> Оставить заявку</a>
                                                <a href="{{ $service->getUrl() }}" class="btn rounded border">Подробнее</a>
                                            </p>
                                            <div class="voffset70"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="voffset20"></div>
                        <p class="loadmore">
                            <a href="{{ \App\Models\Page::getPageUrl(\App\Models\Page::ID_SERVICES_PAGE) }}" class="btn rounded border btn-default">Подробнее</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    @endif

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