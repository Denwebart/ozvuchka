<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($galleryImages))
    <div class="row sortable sortable-gallery-images">
        @foreach($galleryImages as $item)
            <div class="col-sm-3 item gallery-images-item" id="{{ $item->id }}" data-item-id="{{ $item->id }}">
                <div class="thumbnail">
                    <a class="title pull-left m-t-10">
                        <!-- Info text: image info (title, description, image_alt) -->
                        <button role="button" class="pull-left m-l-10 info-popover" data-container="body" title="" data-toggle="popover" data-placement="top" tabindex="0" data-trigger="focus" data-html="true" data-content="@if($item->created_at) <p><b>Создано:</b> {{ \App\Helpers\Date::format($item->created_at, true) }} @endif @if($item->published_at) <p><b>Опубликовано:</b> {{ \App\Helpers\Date::format($item->published_at, true) }} @endif @if($item->video_url) <p><b>URL видео:</b> <a htef='{{ $item->video_url }}'>{{ $item->video_url }}</a> @endif @if($item->description) <p><b>Описание:</b> @if($item->description) <br> {{ $item->description }} @else <span class='text-muted font-12 m-l-10'>не задано</span> @endif </p>@endif <p><b>Альт:</b> @if($item->image_alt) <br> {{ $item->image_alt }} @else <span class='text-muted font-12 m-l-10'>не задан</span> @endif </p>" data-original-title="@if($item->title) <span class='text-dark'> {{ $item->title }} </span> @else <span class='text-muted font-12'> заголовок не задан </span> @endif">
                            {{--<i class="fa fa-info-circle-o"></i>--}}
                            Информация
                        </button>
                    </a>
                    <div class="buttons pull-right m-t-10 m-r-5 m-b-10">
                        <div class="switchery-demo text-right pull-left">
                            {!! Form::hidden('is_published', 0) !!}
                            {!! Form::checkbox('is_published', 1, $item->is_published, ['id' => 'is_published-' . $item->id, 'data-plugin' => 'switchery', 'class' => 'ajax-checkbox', 'data-url' => route('admin.gallery.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $item->id]) !!}
                        </div>
                        <a href="#" class="button-edit pull-left m-l-10" @if($item->video_url) data-gallery-type="video" @endif data-item-id="{{ $item->id }}" data-toggle="modal" data-target="#gallery-modal" data-modal-id="gallery-modal" data-animation="fadein" data-overlaySpeed="200" data-overlayColor="#36404a">
                            <i class="mdi mdi-pencil" title="Редактировать @if($item->video_url) видео @else изображение @endif" data-toggle="tooltip"></i>
                        </a>
                        <a href="#" class="button-delete pull-left m-l-10"  @if($item->video_url) data-gallery-type="video" @endif data-item-id="{{ $item->id }}" data-item-image-url="{{ $item->getImageUrl() }}" title="Удалить @if($item->video_url) видео @else изображение @endif" data-toggle="tooltip">
                            <i class="mdi mdi-close"></i>
                        </a>
                    </div>
                    <img src="{{ $item->getImageUrl() }}" alt="">
                    @if($item->video_url)
                        <span class="type"><i class="fa fa-video-camera"></i></span>
                    @endif
                    <div class="tags">
                        @foreach($item->categories  as $category)
                            <span class="tag label label-default">{{ $category->title }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="background-icon text-center">
        <p>Изображений в галерее нет</p>
        <i class="fa fa-file-image-o"></i>
    </div>
@endif