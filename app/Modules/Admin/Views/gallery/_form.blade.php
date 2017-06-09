<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(isset($galleryImage))
    <div class="modal-body">
        @if($galleryImage->id)
            {!! Form::model($galleryImage, ['route' => ['admin.gallery.update', $galleryImage->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'id' => 'gallery-form']) !!}
        @else
            {!! Form::model($galleryImage, ['route' => ['admin.gallery.store'], 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'gallery-form']) !!}
        @endif
        {!! Form::hidden('deleteImage', 0, ['id' => 'deleteImage']) !!}
        <div class="row">
            <div class="col-md-8">
                @if($galleryImage->created_at)
                    <p>
                        <label for="created_at" class="control-label m-r-5">Дата создания:</label>
                        <span class="date" id="created_at">
                        {{ \App\Helpers\Date::format($galleryImage->created_at, true) }}
                        @if(\App\Helpers\Date::format($galleryImage->created_at, true) != \App\Helpers\Date::getRelative($galleryImage->created_at, true))
                            ({{ \App\Helpers\Date::getRelative($galleryImage->created_at, true) }})
                        @endif
                    </span>
                    </p>
                @endif
                @if($galleryImage->published_at)
                    <p>
                        <label for="published_at" class="control-label m-r-5">Дата публикации:</label>
                        <span class="date" id="published_at">
                        {{ \App\Helpers\Date::format($galleryImage->published_at, true) }}
                        @if(\App\Helpers\Date::format($galleryImage->published_at, true) != \App\Helpers\Date::getRelative($galleryImage->published_at, true))
                            ({{ \App\Helpers\Date::getRelative($galleryImage->published_at, true) }})
                        @endif
                    </span>
                    </p>
                @endif
            </div>
            <div class="col-md-4">
                <div class="switchery-demo @if(!$galleryImage->created_at && !$galleryImage->published_at) m-b-10 @endif">
                    {!! Form::hidden('is_published', 0) !!}
                    {!! Form::checkbox('is_published', 1, $galleryImage->id ? $galleryImage->is_published : 1, ['id' => 'is_published', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                    {!! Form::label('is_published', 'Опубликовано', ['class' => 'control-label m-l-5']) !!}
                </div>
                <span class="help-block error is_published_error text-danger font-12" style="display: none">
                    <i class="fa fa-times-circle"></i>
                    <strong></strong>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                {!! Form::file('image', ['id' => 'image', 'class' => 'dropify', 'data-default-file' => $galleryImage->id ? $galleryImage->getImageUrl() : false, 'data-max-file-size' => '3M']) !!}
                <span class="help-block error image_error text-danger font-12" style="display: none">
                    <i class="fa fa-times-circle"></i>
                    <strong></strong>
                </span>
            </div>
            <div class="col-sm-12">
                <div class="no-margin m-b-20">
                    {!! Form::label('title', 'Заголовок изображения:', ['class' => 'control-label m-b-10']) !!}
                    {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control maxlength', 'maxlength' => 255]) !!}
                    <span class="help-block error title_error text-danger font-12" style="display: none">
                        <i class="fa fa-times-circle"></i>
                        <strong></strong>
                    </span>
                </div>

                <div class="no-margin m-b-20">
                    {!! Form::label('description', 'Описание изображения:', ['class' => 'control-label m-b-10']) !!}
                    {!! Form::textarea('description', null, ['id' => 'description', 'class' => 'form-control maxlength', 'maxlength' => 1000, 'rows' => 2]) !!}
                    <span class="help-block error description_error text-danger font-12" style="display: none">
                        <i class="fa fa-times-circle"></i>
                        <strong></strong>
                    </span>
                </div>

                <div class="no-margin m-b-20">
                    {!! Form::label('image_alt', 'Альт изображения:', ['class' => 'control-label m-b-10']) !!}
                    <!-- Info text: image_alt -->
                    <span class="m-l-10 text-muted help-popover" data-container="body" title="" data-toggle="popover" data-trigger="hover" data-placement="right" tabindex="0" data-content="ALT - это краткое и правдивое описание изображения. Обязательно должен содержать важные ключевые фразы для продвижения изображения (не страницы). Рекомендуемая длина не менее 3-4 слов и не более 255 символов. Поисковики учитывают не весь ALT, а лишь несколько первых слов. Для Google лимит 16 слов, для Яндекса – 28 слов." data-original-title="Атрибут ALT для изображения">
                        <i class="fa fa-question-circle-o"></i>
                    </span>
                    {!! Form::textarea('image_alt', null, ['id' => 'image_alt', 'class' => 'form-control maxlength', 'maxlength' => 255, 'rows' => 2]) !!}
                    <span class="help-block error image_alt_error text-danger font-12" style="display: none">
                        <i class="fa fa-times-circle"></i>
                        <strong></strong>
                    </span>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Закрыть</button>
        <button type="button" class="button-save btn btn-custom waves-effect waves-light">
            @if($galleryImage->id)
                Сохранить изменения
            @else
                Добавить
            @endif
        </button>
    </div>
@endif