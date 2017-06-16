<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($items))
    <section class="section latest-news">
        <div class="container">
            <div class="voffset50"></div>
            @if($title || $description)
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="separator-icon">
                            <i class="fa fa-volume-up"></i>
                        </div>
                        @if($description)
                            <div class="voffset30"></div>
                            <p class="pretitle">{{ $description }}</p>
                        @endif
                        @if($title)
                            <div class="voffset20"></div>
                            <h2 class="title">{{ $title }}</h2>
                        @endif
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="voffset50"></div>
                    <div class="carousel-team-members js-flickity" data-flickity-options='{ "cellAlign": "left", "wrapAround": true, "contain": true, "prevNextButtons": false }'>
                        @foreach($items as $item)
                            <div class="gallery-cell full-xxs col-xs-6 col-sm-4 col-md-4 col-lg-3">
                                <div class="item featured-artist">
                                    <div class="image">
                                        <img src="{{ $item->getPageImage(true) }}" alt="{{ $item->image_alt }}" title="{{ $item->image_alt }}">
                                    </div>
                                    <div class="date-sticker">
                                        <span class="day">{{ \App\Helpers\Date::make($item->published_at, 'j') }}</span>
                                        <span class="month">{{ \App\Helpers\Date::make($item->published_at, 'M') }}</span>
                                        @if(date('Y') != \App\Helpers\Date::make($item->published_at, 'Y'))
                                            <span class="year">{{ \App\Helpers\Date::make($item->published_at, 'Y') }}</span>
                                        @endif
                                    </div>
                                    <div class="rollover">
                                        <div class="text">
                                            <p>
                                                <a href="{{ $item->getUrl() }}">{{ $item->getTitle() }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="voffset120"></div>
        </div>
    </section>
@endif