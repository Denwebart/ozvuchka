<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($slider))
    <div class="sortable sortable-slider">
        @foreach($slider as $item)
            <div class="row item slide-item" id="{{ $item->id }}" data-item-id="{{ $item->id }}">
                <div class="thumbnail p-0 m-b-0">
                    <div class="col-sm-4 p-t-b-10">
                        {!! Form::file('image', ['id' => 'image-' . $item->id, 'class' => 'dropify-ajax', 'data-default-file' => $item->getImageUrl(), 'data-height' => '120px', 'data-max-file-size' => '3M', 'data-item-id' => $item->id, 'data-delete-url' => route('admin.slider.deleteImage'), 'data-upload-url' => route('admin.slider.uploadImage')]) !!}
                    </div>
                    <div class="col-sm-6 p-t-b-10">
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">Заголовок:</b>
                            <a href="#" class="editable-text" data-value="{{ $item->title }}" data-name="title" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('admin.slider.setValue') }}">{{ $item->title }}</a>
                        </p>
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">Текст:</b>
                            <a href="#" class="editable-text" data-value="{{ $item->text }}" data-name="text" data-type="textarea" data-pk="{{ $item->id }}" data-url="{{ route('admin.slider.setValue') }}">{{ $item->text }}</a>
                        </p>
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">Кнопка:</b>
                            <span class="btn btn-default waves-effect waves-light">
                                <a href="#" class="editable-text" data-value="{{ $item->button_text }}" data-name="button_text" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('admin.slider.setValue') }}">{{ $item->button_text }}</a>
                            </span>
                        </p>
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">Ссылка:</b>
                            <a href="#" class="editable-text" data-value="{{ $item->button_link }}" data-name="button_link" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('admin.slider.setValue') }}">{{ $item->button_link }}</a>
                        </p>
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">
                                Альт:
                                <!-- Info text: image_alt -->
                                <span class="m-l-10 text-muted help-popover" data-container="body" title="" data-toggle="popover" data-trigger="hover" data-placement="right" tabindex="0" data-content="ALT - это краткое и правдивое описание изображения. Обязательно должен содержать важные ключевые фразы для продвижения изображения (не страницы). Рекомендуемая длина не менее 3-4 слов и не более 255 символов. Поисковики учитывают не весь ALT, а лишь несколько первых слов. Для Google лимит 16 слов, для Яндекса – 28 слов." data-original-title="Атрибут ALT для изображения">
                                    <i class="fa fa-question-circle-o"></i>
                                </span>
                            </b>
                            <a href="#" class="editable-text" data-value="{{ $item->image_alt }}" data-name="image_alt" data-type="textarea" data-pk="{{ $item->id }}" data-url="{{ route('admin.slider.setValue') }}">{{ $item->image_alt }}</a>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <div class="switchery-demo m-t-10 text-right">
                            {!! Form::hidden('is_published', 0) !!}
                            {!! Form::checkbox('is_published', 1, $item->is_published, ['id' => 'is_published-' . $item->id, 'data-plugin' => 'switchery', 'class' => 'ajax-checkbox', 'data-url' => route('admin.slider.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $item->id]) !!}
                        </div>
                        <div class="buttons pull-right m-t-20 m-r-5">
                            <a href="#" class="delete-item" data-item-id="{{ $item->id }}" title="Удалить слайд" data-toggle="tooltip">
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
        <p>Слайдов нет</p>
        <a href="#" class="open-slider-form">
            <i class="fa fa-image"></i>
        </a>
    </div>
@endif