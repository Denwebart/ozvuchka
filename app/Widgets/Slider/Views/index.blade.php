<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($items))

    <section class="intro full-width jIntro" id="anchor00">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="slider-intro">
                        <div id="slides">
                            <div class="overlay"></div>
                            <div class="slides-container">
                                @foreach($items as $item)
                                    @if($item->getImageUrl())
                                        <img src="{{ $item->getImageUrl() }}" alt="{{ $item->image_alt }}">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="vcenter text-center text-overlay"> <!-- vcenter -->
                {{--<div class="logo-intro"><img src="{{ asset('frontend/images/logo_white.svg') }}" alt=""></div>--}}
                <div id="owl-main-text" class="owl-carousel">
                    @foreach($items as $item)
                        <div class="item">
                            @if($item->title)
                                <h1 class="primary-title">{{ $item->title }}</h1>
                            @endif
                            @if($item->text)
                                <h2 class="subtitle-text">{{ $item->text }}</h2>
                            @endif
                            <div class="voffset50"></div>
                            @if($item->button_link)
                                <a href="{{ $item->button_link }}" class="btn btn-invert">
                                    {{ $item->button_text or 'Узнать больше' }}
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif