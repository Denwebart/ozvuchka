<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="form-editable sortable-slider">
    @foreach($slider as $item)
        <div class="slide-item thumbnail" id="{{ $item->id }}" data-item-id="{{ $item->id }}">
            <div class="row">
                <div class="col-sm-10">
                    <img src="{{ $item->getImageUrl() }}" class="img-responsive">
                    <div class="caption">
                        <h4>
                            <a href="#" class="editable-text" data-value="{{ $item->title }}" data-name="title" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('admin.slider.setValue') }}">{{ $item->title }}</a>
                        </h4>
                        <p>
                            <a href="#" class="editable-text" data-value="{{ $item->text }}" data-name="text" data-type="textarea" data-pk="{{ $item->id }}" data-url="{{ route('admin.slider.setValue') }}">{{ $item->text }}</a>
                        </p>
                        <p>
                            <span class="btn btn-primary waves-effect waves-light">
                                <a href="#" class="editable-text" data-value="{{ $item->button_text }}" data-name="text" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('admin.slider.setValue') }}">{{ $item->button_text }}</a>
                            </span>
                        </p>
                        <p>
                            <a href="#" class="editable-text" data-value="{{ $item->button_link }}" data-name="text" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('admin.slider.setValue') }}">{{ $item->button_link }}</a>
                        </p>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="switchery-demo">
                        {!! Form::hidden('is_active', 0) !!}
                        {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
                    </div>
                    <div class="buttons pull-right">
                        <a href="#" class="delete-item m-r-5" data-item-id="{{ $item->id }}" data-item-title="{{ $item->title }}" title="Удалить слайд" data-toggle="tooltip">
                            <i class="mdi mdi-close"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>