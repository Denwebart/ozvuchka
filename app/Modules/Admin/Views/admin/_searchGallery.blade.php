<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="search-item">
    <div class="media">
        <div class="media-left">
            <a href="{{ route('admin.gallery.index') }}#{{ $result->id }}">
                <img class="media-object" alt="{{ $result->image_alt }}" src="{{ $result->getImageUrl() }}" style="width: 54px; height: 54px;">
            </a>
        </div>
        <div class="media-body">
            <h5 class="media-heading">
                @if($result->title)
                    <a href="{{ route('admin.gallery.index') }}#{{ $result->id }}" class="text-dark">
                        {!! \App\Helpers\Str::getFragment($result->title, $searchQuery) !!}
                    </a>
                @endif
                <span class="label @if($result->is_published) label-success @else label-muted @endif">{{ \App\Models\Gallery::$is_published[$result->is_published] }}</span>
            </h5>
            @if($result->description)
                <p class="font-13">
                    <b>Описание:</b>
                    <br>
                    <span class="text-muted">
                        {!! \App\Helpers\Str::getFragment($result->description, $searchQuery) !!}
                    </span>
                </p>
            @endif
            @if($result->image_alt)
                <p class="m-b-0 font-13">
                    <b>Альт изображения:</b>
                    <br>
                    <span class="text-muted">
                        {!! \App\Helpers\Str::getFragment($result->image_alt, $searchQuery) !!}
                    </span>
                </p>
            @endif
        </div>
    </div>
</div>