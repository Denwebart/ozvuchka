<?php
/**
 * Services View
 *      (PagesController@getServicesPage)
 *
 * Variables:
 *      $page - object App\Models\Page
 *      $services - collection with pages object App\Models\Page
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
    <section class="intro intro-mini full-width jIntro bg-blog border-bottom" style="background-image: url({{ asset('frontend/images/backgrounds/services-bg.jpg') }})" id="anchor00">
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

    <!-- SERVICES -->
    @if(count($services))
        <section class="section upcomming-events-list" style="background: url({{ asset('frontend/images/backgrounds/texture.png') }}) repeat">
            <div class="container">
                <div class="voffset20"></div>
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            @foreach($services as $service)
                                <li>
                                    <div>
                                        <p class="date-event">
                                            @if($service->getPageImage())
                                                <a href="{{ $service->getUrl() }}">
                                                    <img src="{{ $service->getPageImage(false, 'mini') }}" alt="{{ $service->image_alt }}" title="{{ $service->image_alt }}">
                                                </a>
                                            @endif
                                        </p>
                                        <p class="name">
                                            <a href="{{ $service->getUrl() }}">
                                                <span>{{ $service->getTitle() }}</span>
                                            </a>
                                            @if($service->introtext)
                                                {!! strip_tags($service->introtext) !!}
                                            @endif
                                        </p>
                                        <p class="buy">
                                            <a href="{{ $service->getUrl() }}" class="btn rounded icon">Подробнее</a>
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- PAGE CONTENT -->
    @if($page->content)
        <section class="section featured-shop">
            <div class="container">
                <div class="voffset50"></div>
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