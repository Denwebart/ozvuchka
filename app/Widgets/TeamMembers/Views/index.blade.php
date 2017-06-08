<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($items))
    <!-- Reviews Section -->
    <div>
        @if(isset($title))
            <h3>{{ $title }}</h3>
        @endif
        @foreach($items as $item)
            <div class="item">
                <img src="{{ $item->getImageUrl() }}" alt="{{ $item->image_alt }}" width="200px"/>
                <p>{{ $item->name }}</p>
                <p>{{ $item->description }}</p>
                <p>{{ $item->link_vk }}</p>
                <p>{{ $item->link_fb }}</p>
                <p>{{ $item->link_instagram }}</p>
                <p>{{ $item->link_twitter }}</p>
                <p>{{ $item->link_google }}</p>
                <p>{{ $item->link_youtube }}</p>
            </div>
        @endforeach
    </div>
@endif