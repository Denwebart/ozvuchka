<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

{!! csrf_field() !!}

{!! Form::hidden('backUrl', $backUrl) !!}
{!! Form::hidden('returnBack', 1, ['id' => 'returnBack']) !!}
{!! Form::hidden('deleteImage', 0, ['id' => 'deleteImage']) !!}

{!! Form::hidden('type', $page->type) !!}
{{--@if($page->type == \App\Models\Page::TYPE_CATALOG)--}}
    {{--{!! Form::hidden('is_catalog', 1) !!}--}}
{{--@else--}}
    {{--{!! Form::hidden('is_catalog', 0) !!}--}}
{{--@endif--}}

<div class="row">
    <div class="col-lg-6 col-sm-12 col-xs-12 m-b-15">
        <div class="form-group @if($errors->has('parent_id')) has-error @endif">
            {!! Form::label('parent_id', 'Категория', ['class' => 'col-sm-2 col-md-2 control-label']) !!}
            <div class="col-sm-10 col-md-10">
                @if($page->canBeDeleted())
                    <select class="selectpicker" data-style="btn-custom">
                        @foreach(\App\Models\Page::getCategory() as $item)
                            <option>{{ $item }}</option>
                        @endforeach
                    </select>

                    {{--{!! Form::select('parent_id', \App\Models\Page::getCategory(), $page->parent_id, ['id' => 'parent_id', 'class' => 'form-control']) !!}--}}
                @else
                    {!! Form::hidden('parent_id', $page->parent_id) !!}
                    {!! Form::select('parent_id', \App\Models\Page::getCategory(), $page->parent_id, ['id' => 'parent_id', 'class' => 'form-control', 'disabled' => true]) !!}
                @endif
                @if($errors->has('parent_id'))
                    <span class="error help-block text-danger font-12">
                        <i class="fa fa-times-circle"></i>
                        <strong>{{ $errors->first('parent_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('alias')) has-error @endif">
            {!! Form::label('alias', 'Алиас', ['class' => 'col-sm-2 col-md-2 control-label']) !!}
            <div class="col-sm-10 col-md-10">
                @if(!$page->isMain())
                    {!! Form::text('alias', $page->alias, ['id' => 'alias', 'class' => 'form-control']) !!}
                @else
                    {!! Form::text('alias', $page->alias, ['id' => 'alias', 'class' => 'form-control', 'disabled' => true]) !!}
                @endif

                @if($errors->has('alias'))
                    <span class="error help-block text-danger font-12">
                        <i class="fa fa-times-circle"></i>
                        <strong>{{ $errors->first('alias') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('title')) has-error @endif">
            {!! Form::label('title', 'Заголовок', ['class' => 'col-sm-2 col-md-2 control-label']) !!}
            <div class="col-sm-10 col-md-10">
                {!! Form::text('title', $page->title, ['id' => 'title', 'class' => 'form-control']) !!}

                @if($errors->has('title'))
                    <span class="error help-block text-danger font-12">
                        <i class="fa fa-times-circle"></i>
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('menu_title')) has-error @endif">
            {!! Form::label('menu_title', 'Заголовок меню', ['class' => 'col-sm-2 col-md-2 control-label']) !!}
            <div class="col-sm-10 col-md-10">
                {!! Form::text('menu_title', $page->menu_title, ['id' => 'menu_title', 'class' => 'form-control']) !!}

                @if($errors->has('menu_title'))
                    <span class="error help-block text-danger font-12">
                        <i class="fa fa-times-circle"></i>
                        <strong>{{ $errors->first('menu_title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        @if($page->canBeDeleted())
            <div class="form-group @if($errors->has('is_container')) has-error @endif">
                <div class="col-md-2">
                </div>
                <div class="col-md-4 switchery-demo">
                    {!! Form::hidden('is_container', 0) !!}
                    {!! Form::checkbox('is_container', 1, $page->is_container, ['id' => 'is_container', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                    {!! Form::label('is_container', 'Категория', ['class' => 'control-label m-l-5']) !!}
                </div>
                <div class="col-md-6">
                    <span class="help-block m-t-0">
                        <small>Будет ли содержать вложенные страницы?</small>
                    </span>
                </div>
                @if($errors->has('is_container'))
                    <span class="error help-block text-danger font-12">
                        <i class="fa fa-times-circle"></i>
                        <strong>{{ $errors->first('is_container') }}</strong>
                    </span>
                @endif
            </div>
        @endif
        <div class="form-group">
            <div class="col-sm-6 col-md-6 @if($errors->has('image')) has-error @endif">
                {!! Form::label('image', 'Изображение для страницы', ['class' => 'control-label m-b-5']) !!}
                {!! Form::file('image', ['id' => 'image', 'class' => 'dropify', 'data-default-file' => $page->getImageUrl(), 'data-max-file-size' => '3M']) !!}
                <span class="help-block @if($errors->has('image')) hidden @endif">
                    <small>
                        Изображение отображается перед текстом страницы
                        и при выводе страниц блогом.
                        <br>
                        Рекомендуемая ширина – 800px.
                    </small>
                </span>
                @if($errors->has('image'))
                    <span class="error help-block text-danger font-12">
                        <i class="fa fa-times-circle"></i>
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-sm-6 col-md-6 @if($errors->has('image_alt')) has-error @endif">
                {!! Form::label('image_alt', 'Альт для изображения', ['class' => 'control-label m-b-5']) !!}
                {!! Form::textarea('image_alt', $page->image_alt, ['id' => 'image_alt', 'class' => 'form-control', 'rows' => 8]) !!}

                @if($errors->has('image_alt'))
                    <span class="error help-block text-danger font-12">
                        <i class="fa fa-times-circle"></i>
                        <strong>{{ $errors->first('image_alt') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-lg-6 col-sm-12 col-xs-12 m-b-15">
        <div class="form-group @if($errors->has('meta_title')) has-error @endif">
            {!! Form::label('meta_title', 'Мета-тег Title', ['class' => 'col-sm-2 col-md-2 control-label']) !!}
            <div class="col-sm-10 col-md-10">
                {!! Form::textarea('meta_title', $page->meta_title, ['id' => 'meta_title', 'class' => 'form-control', 'rows' => 2]) !!}

                <span class="help-block @if($errors->has('meta_title')) hidden @endif">
                    <small>Самый важный SEO-тег. Рекомендуемая длина - 65 символов.</small>
                </span>
                @if($errors->has('meta_title'))
                    <span class="error help-block text-danger font-12">
                        <i class="fa fa-times-circle"></i>
                        <strong>{{ $errors->first('meta_title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('meta_desc')) has-error @endif">
            {!! Form::label('meta_desc', 'Мета-тег Description', ['class' => 'col-sm-2 col-md-2 control-label']) !!}
            <div class="col-sm-10 col-md-10">
                {!! Form::textarea('meta_desc', $page->meta_desc, ['id' => 'meta_desc', 'class' => 'form-control', 'rows' => 3]) !!}

                <span class="help-block @if($errors->has('meta_desc')) hidden @endif">
                    <small>Второй по важности SEO-тег. Рекомендуемая длина - 160 символов.</small>
                </span>
                @if($errors->has('meta_desc'))
                    <span class="error help-block text-danger font-12">
                        <i class="fa fa-times-circle"></i>
                        <strong>{{ $errors->first('meta_desc') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('meta_key')) has-error @endif">
            {!! Form::label('meta_key', 'Мета-тег Keywords', ['class' => 'col-sm-2 col-md-2 control-label']) !!}
            <div class="col-sm-10 col-md-10">
                {!! Form::textarea('meta_key', $page->meta_key, ['id' => 'meta_key', 'class' => 'form-control', 'rows' => 3]) !!}

                <span class="help-block @if($errors->has('meta_key')) hidden @endif">
                    <small>Необязательный SEO-тег. Существительные в единственном числе через запятую.</small>
                </span>
                @if($errors->has('meta_key'))
                    <span class="error help-block text-danger font-12">
                        <i class="fa fa-times-circle"></i>
                        <strong>{{ $errors->first('meta_key') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('is_published')) has-error @endif">
            <div class="col-md-2">
            </div>
            <div class="col-md-4 switchery-demo">
                @if($page->canBeDeleted())
                    {!! Form::hidden('is_published', 0) !!}
                    {!! Form::checkbox('is_published', 1, $page->is_published, ['id' => 'is_published', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                @else
                    {!! Form::hidden('is_published', 1) !!}
                    {!! Form::checkbox('is_published', 1, $page->is_published, ['id' => 'is_published', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small', 'disabled' => true]) !!}
                @endif
                {!! Form::label('is_published', 'Опубликована', ['class' => 'control-label m-l-5']) !!}
            </div>
            <div class="col-md-6">
                @if(!$page->published_at)
                    (сохраните, чтоб опубликовать)
                @else
                    {{ \App\Helpers\Date::format($page->published_at) }}
                @endif

                @if($errors->has('is_published'))
                    <span class="error help-block text-danger font-12">
                        <i class="fa fa-times-circle"></i>
                        <strong>{{ $errors->first('is_published') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        {{--<div class="form-group">--}}
        {{--{!! Form::label('published_at', 'Дата/время публикации', ['class' => 'col-sm-2 col-md-2 control-label']) !!}--}}
        {{--<div class="col-md-5">--}}
        {{--<div class="input-group">--}}
        {{--<input name="published_date" type="text" class="form-control" placeholder="день.месяц.год" id="datepicker" value="">--}}
        {{--<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>--}}
        {{--</div><!-- input-group -->--}}
        {{--</div>--}}
        {{--<div class="col-md-5">--}}
        {{--<div class="input-group">--}}
        {{--<div class="bootstrap-timepicker">--}}
        {{--<input name="published_time" id="timepicker" type="text" class="form-control" value="">--}}
        {{--</div>--}}
        {{--<span class="input-group-addon bg-primary b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>--}}
        {{--</div><!-- input-group -->--}}
        {{--</div>--}}
        {{--</div>--}}
    </div><!-- end col -->

    <div class="col-md-7 col-sm-12 col-xs-12">
        <div class="form-group @if($errors->has('content')) has-error @endif">
            <div class="col-md-12">
                {!! Form::label('content', 'Текст страницы', ['class' => 'control-label m-b-5']) !!}
                {{--@if($page->type == \App\Models\Page::TYPE_CATALOG)--}}
                    {{--<span class="help-block">--}}
                        {{--<small>--}}
                            {{--Отображается вверху страницы, над списком товаров.--}}
                        {{--</small>--}}
                    {{--</span>--}}
                {{--@endif--}}

                {!! Form::textarea('content', $page->content, ['id' => 'content', 'class' => 'form-control editor', 'rows' => 10]) !!}

                @if($errors->has('content'))
                    <span class="error help-block text-danger font-12">
                        <i class="fa fa-times-circle"></i>
                        <strong>{{ $errors->first('content') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-5 col-sm-12 col-xs-12">
        <div class="form-group @if($errors->has('introtext')) has-error @endif">
            <div class="col-md-12">
                {!! Form::label('introtext', 'Краткое описание страницы', ['class' => 'control-label m-b-5']) !!}
                {{--@if($page->type == \App\Models\Page::TYPE_CATALOG)--}}
                    {{--<span class="help-block">--}}
                        {{--<small>--}}
                            {{--Отображается внизу страницы, после списка товаров.--}}
                        {{--</small>--}}
                    {{--</span>--}}
                {{--@endif--}}

                {!! Form::textarea('introtext', $page->introtext, ['id' => 'introtext', 'class' => 'form-control editor', 'rows' => 10]) !!}

                @if($errors->has('introtext'))
                    <span class="error help-block text-danger font-12">
                        <i class="fa fa-times-circle"></i>
                        <strong>{{ $errors->first('introtext') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="text-right m-b-0">
            <button type="button" class="btn btn-custom waves-effect waves-light button-save-exit">
                <i class="fa fa-arrow-left"></i>
                <span>Сохранить и выйти</span>
            </button>
            <button type="button" class="btn btn-custom waves-effect waves-light button-save">
                <i class="fa fa-check"></i>
                <span class="hidden-sm">Сохранить</span>
            </button>
            <a href="{{ $backUrl }}" class="btn btn-default waves-effect waves-light button-cancel">
                <i class="fa fa-close"></i>
                <span class="hidden-md hidden-sm">Отмена</span>
            </a>
        </div>
    </div>

</div><!-- end row -->

@push('styles')
<link href="{{ asset('backend/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/plugins/summernote/summernote.css') }}" rel="stylesheet" type="text/css" />
{{--<link href="{{ asset('backend/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">--}}
{{--<link href="{{ asset('backend/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">--}}
@endpush

@push('scripts')
<!-- Init Js file -->
<script type="text/javascript" src="{{ asset('backend/pages/jquery.form-advanced.init.js') }}"></script>


<script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>
<script src="{{ asset('backend/plugins/fileuploads/js/dropify.min.js') }}"></script>
<script src="{{ asset('backend/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('backend/plugins/summernote/lang/summernote-ru-RU.js') }}"></script>
{{--<script src="{{ asset('backend/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>--}}
{{--<script src="{{ asset('backend/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>--}}

<script type="text/javascript">

    // Buttons
    $(document).on('click', '.button-save-exit', function() {
        $("#returnBack").val('1');
        $("#main-form").submit();
    });
    $(document).on('click', '.button-save', function() {
        $("#returnBack").val('0');
        $("#main-form").submit();
    });


    // Image Uploader
//    var drEvent = $('.dropify').dropify({
//        messages: {
//            'default': 'Кликните или перетащите файл.',
//            'replace': 'Кликните или перетащите файл для замены.',
//            'remove': 'Удалить',
//            'error': 'Ошибка.'
//        },
//        error: {
//            'fileSize': 'Размер файла слишком большой (максимум 3Мб).'
//        }
//    });
//
//    drEvent.on('dropify.afterClear', function(event, element){
//        $('#deleteImage').val(1);
//    });

    // WYSIWYG
//    $(document).ready(function() {
//        $('.editor').summernote({
//            lang: 'ru-RU',
//            height: 300,                 // set editor height
//            minHeight: null,             // set minimum height of editor
//            maxHeight: null,             // set maximum height of editor
//            focus: false                  // set focus to editable area after initializing summernote
//        });
//    });


    //        // Time Picker
    //        jQuery('#timepicker').timepicker({
    //            showMeridian : false
    //        });
    //
    //        // Date Picker
    //        $.fn.datepicker.dates['ru'] = {
    //            days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
    //            daysShort: ["Вск", "Пнд", "Втр", "Срд", "Чтв", "Птн", "Суб"],
    //            daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
    //            months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
    //            monthsShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
    //            today: "Сегодня",
    //            clear: "Очистить",
    //            format: "dd.mm.yyyy",
    //            weekStart: 1
    //        };
    //        jQuery('#datepicker').datepicker({
    //            autoclose: true,
    //            todayHighlight: true,
    //            language: 'ru'
    //        });

</script>
@endpush