<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(!$galleryImage->video_url)
    <div class="thumbnail small @foreach($galleryCategories as $category) tag-{{ $category->id }} @endforeach">
        <a href="{{ $galleryImage->getImageUrl('full') }}" title="{{ $galleryImage->title }}" class="swipebox">
            <img src="{{ $galleryImage->getImageUrl() }}" alt="{{ $galleryImage->image_alt }}" title="{{ $galleryImage->image_alt }}">
            <div class="rollover">
                <i class="plus"></i>
            </div>
        </a>
    </div>
@else
    <div class="thumbnail video small @foreach($galleryCategories as $category) tag-{{ $category->id }} @endforeach">
        <a class="swipebox swipebox-video" href="{{ $galleryImage->video_url }}" title="{{ $galleryImage->title }}">
            <img src="{{ $galleryImage->getImageUrl() }}" alt="{{ $galleryImage->image_alt }}" title="{{ $galleryImage->image_alt }}">
            <div class="rollover">
                <i class="video"></i>
            </div>
        </a>
    </div>
@endif