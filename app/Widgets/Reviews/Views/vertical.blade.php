<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($items))
    <!-- Reviews Section -->
    @if($title)
        <div class="title small">{{ $title }}</div>
    @endif
    <div class="last-comments">
        <ul>
            @foreach($items as $item)
                <li>
                    <div class="header-comment">
                        <div class="pull-left">
                            <img src="{{ $item->getImageUrl('mini') }}" alt="{{ $item->user_name }}" title="{{ $item->user_name }}" width="50px">
                        </div>
                        <div class="title-post">
                            <div class="date">{{ \App\Helpers\Date::getRelative($item->published_at) }}</div>
                            <p>{{ $item->user_name }}:</p>
                        </div>
                    </div>
                    <div class="comment">
                        <p>
                            “
                            {{ $item->text }}
                            ”
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif