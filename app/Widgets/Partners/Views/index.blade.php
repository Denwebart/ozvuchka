<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<!-- PARTNERS -->
@if(count($items))
    <section class="section discography inverse-color" id="anchor04">
        <div id="discography"></div>
        <div class="container">
            @if($title || $description)
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        @if($title)
                            <h4 class="upcomming-events-list-title">Мы сотрудничаем</h4>
                        @endif
                    </div>
                </div>
            @endif
            <!--<div class="voffset50"></div>-->
            <div class="row">
                <div class="col-md-12">
                    <ul class="carousel-discography js-flickity" data-flickity-options='{ "cellAlign": "left", "wrapAround": true, "contain": true, "prevNextButtons": false }'>
                        <!-- col-xlg-3 -->

                        @foreach($items as $item)
                            <li class="gallery-cell col-xs-12 col-sm-6 col-md-3">
                                <div class="info-album">
                                    <div class="cover open-disc" data-url="discs/disc-01.html">
                                        <img src="{{  $item->getImageUrl() }}" alt="{{ $item->image_alt }}" title="{{ $item->image_alt }}">
                                        <div class="rollover">
                                            <ul class="social">
                                                @if($item->link_vk)<li><a href="{{ $item->link_vk }}"><i class="fa fa-vk"></i></a></li>@endif
                                                @if($item->link_facebook)<li><a href="{{ $item->link_facebook }}"><i class="fa fa-facebook"></i></a></li>@endif
                                                @if($item->link_instagram)<li><a href="{{ $item->link_instagram }}"><i class="fa fa-instagram"></i></a></li>@endif
                                                @if($item->link_twitter)<li><a href="{{ $item->link_twitter }}"><i class="fa fa-twitter"></i></a></li>@endif
                                                @if($item->link_google)<li><a href="{{ $item->link_google }}"><i class="fa fa-google-plus"></i></a></li>@endif
                                                @if($item->link_youtube)<li><a href="{{ $item->link_youtube }}"><i class="fa fa-youtube"></i></a></li>@endif
                                            </ul>
                                            <div class="text">
                                                @if($item->description)
                                                    <p>
                                                        {{ $item->description }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if($item->title)
                                        <p class="album">{{ $item->title }}</p>
                                    @endif
                                </div>
                            </li>
                        @endforeach
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
@endif