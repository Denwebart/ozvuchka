<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($reviews))
    <p class="text-muted font-13 m-b-10">
        Всего:
        {{ count($reviews) }}
    </p>
    <div class="sortable sortable-reviews">
        @foreach($reviews as $item)
            <div class="row item reviews-item" id="{{ $item->id }}" data-item-id="{{ $item->id }}">
                <div class="thumbnail p-0 m-b-0">
                    <div class="col-sm-4 p-t-b-10">
                        {!! Form::file('user_avatar', ['id' => 'user_avatar-' . $item->id, 'class' => 'dropify-ajax', 'data-default-file' => $item->getImageUrl(), 'data-height' => '120px', 'data-max-file-size' => '3M', 'data-min-width' => '49', 'data-min-height' => '49', 'data-item-id' => $item->id, 'data-delete-url' => route('admin.reviews.deleteImage'), 'data-upload-url' => route('admin.reviews.uploadImage')]) !!}
                    </div>
                    <div class="col-sm-6 p-t-b-10">
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">Имя:</b>
                            <a href="#" class="editable-text" data-value="{{ $item->user_name }}" data-name="user_name" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('admin.reviews.setValue') }}">{{ $item->user_name }}</a>
                        </p>
                        {{--<p>--}}
                            {{--<b class="font-13 text-muted" style="width: 75px; display: inline-block">Email:</b>--}}
                            {{--<a href="#" class="editable-text" data-value="{{ $item->user_email }}" data-name="user_email" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('admin.reviews.setValue') }}">{{ $item->user_email }}</a>--}}
                        {{--</p>--}}
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">Отзыв:</b>
                            <a href="#" class="editable-text" data-value="{{ $item->text }}" data-name="text" data-type="textarea" data-pk="{{ $item->id }}" data-url="{{ route('admin.reviews.setValue') }}">{{ $item->text }}</a>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <div class="switchery-demo m-t-10 text-right">
                            {!! Form::hidden('is_published', 0) !!}
                            {!! Form::checkbox('is_published', 1, $item->is_published, ['id' => 'is_published-' . $item->id, 'data-plugin' => 'switchery', 'class' => 'ajax-checkbox', 'data-url' => route('admin.reviews.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $item->id]) !!}
                        </div>
                        <div class="buttons pull-right m-t-20 m-r-5">
                            <a href="#" class="delete-item" data-item-id="{{ $item->id }}" title="Удалить отзыв" data-toggle="tooltip">
                                <i class="mdi mdi-close"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="background-icon text-center p-t-b-20">
        <p>Отзывов нет</p>
        <a href="#" class="open-review-form">
            <i class="fa fa-commenting-o"></i>
        </a>
    </div>
@endif