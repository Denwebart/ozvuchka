<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($items))
    <!-- Slider section -->
    <div class="content p-t-0 p-b-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="category-slider single-slider">
                        <ul class="animated-arrows">
                            @foreach($items as $item)
                                <li class="hover-squared">
                                    <img src="{{ $item->getImageUrl() }}" alt="{{ $item->image_alt }}"/>
                                    <div class="single-slider__text {{ \App\Models\Slider::$textAlignClasses[$item->text_align] }}">
                                        @if($item->title) <p class="line-1">{{ $item->title }}</p> @endif
                                        @if($item->text_1) <p class="line-2">{{ $item->text_1 }}</p> @endif
                                        @if($item->text_2) <p class="line-3">{{ $item->text_2 }}</p> @endif
                                        @if($item->button_link)
                                            <a href="{{ $item->button_link }}" class="btn btn--wd btn--lg text-uppercase">
                                                {{ $item->button_text or 'Подробнее' }}
                                            </a>
                                        @endif
                                    </div>
                                    <div class="product-category__hover caption"></div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Slider section -->
@endif

@push('scripts')
    <script type="text/javascript">
        jQuery(function($j) {

            "use strict";

            // Simple slider Start (slider on main page)
            window.setTimeout(function () {
                $j('.single-slider').css({
                    'opacity': '1'
                })
            }, 0); // 500

            $j('.single-slider > ul').slick({
                infinite: false,
                dots: false,
                arrows: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        dots: true
                    }
                }]
            });
            // Simple slider End
        });
    </script>
@endpush