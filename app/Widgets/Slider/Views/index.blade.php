<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($items))
    @foreach($items as $item)
        <div>
            <img src="{{ $item->getImageUrl() }}" alt="{{ $item->image_alt }}" width="200px"/>
            @if($item->title) <p class="title">{{ $item->title }}</p> @endif
            @if($item->text) <p class="text">{{ $item->text }}</p> @endif
            @if($item->button_link)
                <a href="{{ $item->button_link }}">
                    {{ $item->button_text or 'Подробнее' }}
                </a>
            @endif
        </div>
    @endforeach
@endif