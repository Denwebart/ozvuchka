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

    <!-- SERVICES -->
    @if(count($services))
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
                            @foreach($services as $service)
                                <li>
                                    <div>
                                        <p class="date-event">
                                            @if($service->getPageImage())
                                                <a href="{{ $page->getUrl() }}">
                                                    <img src="{{ $service->getPageImage(false, 'mini') }}" alt="{{ $service->image_alt }}" title="{{ $service->image_alt }}">
                                                </a>
                                            @endif
                                        </p>
                                        <p class="name">
                                            <a href="{{ $page->getUrl() }}">
                                                <span>{{ $service->menu_title }}</span>
                                            </a>
                                            @if($service->introtext) {{ $service->introtext }} @endif
                                        </p>
                                        <p class="price">

                                        </p>
                                        <p class="buy">
                                            <a href="#" class="btn rounded icon"><i class="fa fa-ticket"></i> оставить заявку</a>
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