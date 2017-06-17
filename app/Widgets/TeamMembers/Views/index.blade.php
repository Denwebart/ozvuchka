<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<!-- OUR TEAM -->
@if(count($items))
    <section class="section featured-artists" id="anchor02">
        <div class="container">
            @if($title || $description)
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="voffset50"></div>
                        <div class="separator-icon">
                            <i class="fa fa-microphone"></i>
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
                            <div class="gallery-cell full-xxs col-xs-6 col-sm-6 col-md-4 col-lg-3">
                                <div class="featured-artist">
                                    <div class="image">
                                        <img src="{{  $item->getImageUrl() }}" alt="{{ $item->image_alt }}" title="{{ $item->image_alt }}">
                                    </div>
                                    <div class="rollover">
                                        <ul class="social">
                                            @if($item->link_website)<li><a href="{{ $item->link_website }}" target="_blank" rel="nofollow, noopener"><i class="fa fa-globe"></i></a></li>@endif
                                            @if($item->link_vk)<li><a href="{{ $item->link_vk }}" target="_blank" rel="nofollow, noopener"><i class="fa fa-vk"></i></a></li>@endif
                                            @if($item->link_facebook)<li><a href="{{ $item->link_facebook }}" target="_blank" rel="nofollow, noopener"><i class="fa fa-facebook"></i></a></li>@endif
                                            @if($item->link_instagram)<li><a href="{{ $item->link_instagram }}" target="_blank" rel="nofollow, noopener"><i class="fa fa-instagram"></i></a></li>@endif
                                            @if($item->link_twitter)<li><a href="{{ $item->link_twitter }}" target="_blank" rel="nofollow, noopener"><i class="fa fa-twitter"></i></a></li>@endif
                                            @if($item->link_google)<li><a href="{{ $item->link_google }}" target="_blank" rel="nofollow, noopener"><i class="fa fa-google-plus"></i></a></li>@endif
                                            @if($item->link_youtube)<li><a href="{{ $item->link_youtube }}" target="_blank" rel="nofollow, noopener"><i class="fa fa-youtube"></i></a></li>@endif
                                        </ul>
                                        <div class="text">
                                            @if($item->name)
                                                <h4 class="title-artist">
                                                    {{ $item->name }}
                                                </h4>
                                            @endif
                                            @if($item->description)
                                                <p>
                                                    {{ $item->description }}
                                                </p>
                                            @endif
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