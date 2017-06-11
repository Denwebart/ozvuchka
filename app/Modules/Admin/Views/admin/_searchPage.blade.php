<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="search-item">
    <h3 class="h5 font-600 m-b-5">
        <a href="{{ $result->getUrl() }}">
            {!! \App\Helpers\Str::getFragment($result->getTitle(), $searchQuery) !!}
        </a>
        <span class="label @if($result->is_published) label-success @else label-muted @endif">{{ \App\Models\Page::$is_published[$result->is_published] }}</span>
    </h3>
    <div class="font-13 text-success m-b-10">
        {!! \App\Helpers\Str::getFragment($result->getUrl(), $searchQuery) !!}
    </div>
    @if($result->content)
        <p class="m-b-0">
            {!! \App\Helpers\Str::getFragment($result->content, $searchQuery) !!}
        </p>
    @endif
</div>