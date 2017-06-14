<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($items))
    <section class="section last-media border-top border-bottom" style="background: url({{ asset('frontend/images/backgrounds/gallery-widget.jpg') }})">
        <div class="container">
            @if($title || $description)
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="voffset50"></div>
                        @if($description)
                            <p class="pretitle">{{ $description }}</p>
                        @endif
                        @if($title)
                            <div class="voffset20"></div>
                            <h2 class="title">{{ $title }}</h2>
                        @endif
                    </div>
                </div>
            @endif
            <!-- gallery -->
            <div class="row">
                <div class="col-md-12">
                    <div class="voffset50"></div>
                    <div class="thumbnails">
                        @foreach($items as $item)
                            <div class="thumbnail small music">
                                <a href="{{ $item->getImageUrl('full') }}" class="swipebox">
                                    <img src="{{ $item->getImageUrl() }}" alt="{{ $item->image_alt }}" title="{{ $item->image_alt }}">
                                    <div class="rollover">
                                        <i class="plus"></i>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="voffset50"></div>
                    <p class="loadmore">
                        <a href="{{ \App\Models\Page::getPageUrl(\App\Models\Page::ID_GALLERY_PAGE) }}" class="btn rounded border btn-dark">
                            Смотреть еще
                        </a>
                    </p>
                    <div class="voffset80"></div>
                </div>
            </div>
        </div>
    </section>
@endif