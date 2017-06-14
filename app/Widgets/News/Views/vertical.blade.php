<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($items))
    @if($description)
        <div class="title small">{{ $description }}</div>
    @endif
    <div class="last-posts-sidebar">
        <ul>
            @foreach($items as $item)
                <li>
                    <a href="{{ $item->getUrl() }}" class="pull-left">
                        <img src="{{ $item->getPageImage(true, 'mini') }}" alt="{{ $item->image_alt }}" title="{{ $item->image_alt }}">
                    </a>
                    <div class="title-post">
                        <div class="date">{{ \App\Helpers\Date::format($item->published_at, false, true) }}</div>
                        <p>
                            {{ $item->getTitle() }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif