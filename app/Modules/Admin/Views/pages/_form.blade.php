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

<!-- TinyMCE image -->
{{ Form::file('editorImage', ['style' => 'display:none', 'id' => 'editorImage']) }}
{{ Form::hidden('tempPath', $page->getTempPath(), ['id' => 'tempPath']) }}

<!-- Creating a page with a specific type -->
{!! Form::hidden('type', $page->type) !!}

<div class="row">
    <div class="col-lg-6 col-sm-12 col-xs-12 m-b-15">
        <div class="form-group @if($errors->has('parent_id')) has-error @endif">
            {!! Form::label('parent_id', 'Категория', ['class' => 'col-sm-2 col-md-2 control-label']) !!}
            <div class="col-sm-10 col-md-10">
                @if($page->canBeDeleted())
                    <select name="parent_id" id="parent_id" class="selectpicker" data-style="btn-custom">
                        @foreach(\App\Models\Page::getCategory() as $key => $item)
                            <option value="{{ $key }}" @if($page->parent_id == $key) selected @endif>{{ $item }}</option>
                        @endforeach
                    </select>
                @else
                    {!! Form::hidden('parent_id', $page->parent_id) !!}
                    <select name="parent_id" id="parent_id" class="selectpicker" disabled data-style="btn-custom">
                        @foreach(\App\Models\Page::getCategory() as $key => $item)
                            <option value="{{ $key }}" @if($page->parent_id == $key) selected @endif>{{ $item }}</option>
                        @endforeach
                    </select>
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
            <div class="col-sm-2 col-md-2">
                <!-- Info text: image_alt -->
                <span class="m-l-10 text-muted pull-right m-t-5 help-popover" data-container="body" title="" data-toggle="popover" data-trigger="hover" data-placement="right" tabindex="0" data-trigger="focus" data-content="Алиас - это название создаваемой страницы сайта, которое будет отображаться рядом с доменным именем сайта в строке браузера. Если поле не заполнено - заполняется автоматически. Желательно не менять, если страница уже проиндексирована поисковиками." data-original-title="Алиас">
                    <i class="fa fa-question-circle-o"></i>
                </span>
                {!! Form::label('alias', 'Алиас', ['class' => 'control-label pull-right']) !!}
            </div>
            <div class="col-sm-10 col-md-10">
                @if(!$page->isMain())
                    {!! Form::text('alias', $page->alias, ['id' => 'alias', 'class' => 'form-control maxlength', 'maxlength' => 255]) !!}
                @else
                    {!! Form::text('alias', $page->alias, ['id' => 'alias', 'class' => 'form-control maxlength', 'maxlength' => 255, 'disabled' => true]) !!}
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
                {!! Form::text('title', $page->title, ['id' => 'title', 'class' => 'form-control maxlength', 'maxlength' => 255]) !!}

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
                {!! Form::text('menu_title', $page->menu_title, ['id' => 'menu_title', 'class' => 'form-control maxlength', 'maxlength' => 50]) !!}

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
                    <span class="help-block">
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
                <!-- Info text: image_alt -->
                <span class="m-l-10 text-muted help-popover" data-container="body" title="" data-toggle="popover" data-trigger="hover" data-placement="right" tabindex="0" data-trigger="focus" data-content="ALT - это краткое и правдивое описание изображения. Обязательно должен содержать важные ключевые фразы для продвижения изображения (не страницы). Рекомендуемая длина не менее 3-4 слов и не более 255 символов. Поисковики учитывают не весь ALT, а лишь несколько первых слов. Для Google лимит 16 слов, для Яндекса – 28 слов." data-original-title="Атрибут ALT для изображения">
                    <i class="fa fa-question-circle-o"></i>
                </span>
                {!! Form::textarea('image_alt', $page->image_alt, ['id' => 'image_alt', 'class' => 'form-control maxlength', 'maxlength' => 255, 'rows' => 8]) !!}

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
                {!! Form::textarea('meta_title', $page->meta_title, ['id' => 'meta_title', 'class' => 'form-control maxlength', 'maxlength' => 100, 'rows' => 2]) !!}

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
                {!! Form::textarea('meta_desc', $page->meta_desc, ['id' => 'meta_desc', 'class' => 'form-control maxlength', 'maxlength' => 255, 'rows' => 3]) !!}

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
                {!! Form::textarea('meta_key', $page->meta_key, ['id' => 'meta_key', 'class' => 'form-control maxlength', 'maxlength' => 255, 'rows' => 3]) !!}

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
                @if(!$page->isMain())
                    {!! Form::hidden('is_published', 0) !!}
                    {!! Form::checkbox('is_published', 1, $page->is_published, ['id' => 'is_published', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                @else
                    {!! Form::hidden('is_published', 1) !!}
                    {!! Form::checkbox('is_published', 1, $page->is_published, ['id' => 'is_published', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small', 'disabled' => true]) !!}
                @endif
                {!! Form::label('is_published', 'Опубликована', ['class' => 'control-label m-l-5']) !!}
            </div>
            <div class="col-md-6">
                <span class="help-block">
                    <small>
                        @if(!$page->published_at)
                            (сохраните, чтоб опубликовать)
                        @else
                            {{ \App\Helpers\Date::format($page->published_at, true, true) }}
                        @endif
                    </small>
                </span>

                @if($errors->has('is_published'))
                    <span class="error help-block text-danger font-12">
                        <i class="fa fa-times-circle"></i>
                        <strong>{{ $errors->first('is_published') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        {{--<div class="form-group">--}}
            {{--<div class="col-sm-10 col-sm-offset-2">--}}
                {{--{!! Form::label('published_at', 'Отложить публикацию:', ['class' => 'control-label m-b-10']) !!}--}}
                {{--<!-- Info text: published_at -->--}}
                {{--<span class="m-l-10 text-muted help-popover" data-container="body" title="" data-toggle="popover" data-trigger="hover" data-placement="right" tabindex="0" data-trigger="focus" data-content="Страница будет опубликована на сайте не сразу, а в заданное время." data-original-title="Отложенная публикация">--}}
                    {{--<i class="fa fa-question-circle-o"></i>--}}
                {{--</span>--}}
            {{--</div>--}}
            {{--<div class="col-sm-5 col-sm-offset-2">--}}
                {{--<div class="input-group">--}}
                    {{--<input name="published_date" type="text" class="form-control datepicker" placeholder="Дата" value="">--}}
                    {{--<span class="input-group-addon"><i class="mdi mdi-calendar"></i></span>--}}
                {{--</div><!-- input-group -->--}}
            {{--</div>--}}
            {{--<div class="col-sm-5">--}}
                {{--<div class="input-group">--}}
                    {{--<input name="published_time" type="text" class="form-control timepicker" placeholder="Время"  value="">--}}
                    {{--<span class="input-group-addon"><i class="mdi mdi-clock"></i></span>--}}
                {{--</div><!-- input-group -->--}}
            {{--</div>--}}
            {{--<div class="col-sm-5 col-sm-offset-2 m-t-20">--}}
                {{--<div class="input-group">--}}
                    {{--<input name="published_at" type="text" class="form-control datetimepicker" placeholder="Дата публикации"  value="">--}}
                    {{--<span class="input-group-addon"><i class="mdi mdi-clock"></i></span>--}}
                {{--</div><!-- input-group -->--}}
            {{--</div>--}}
        {{--</div>--}}
    </div><!-- end col -->

    <div class="col-md-7 col-sm-12 col-xs-12">
        <div class="form-group @if($errors->has('content')) has-error @endif">
            <div class="col-md-12">
                {!! Form::label('content', 'Текст страницы', ['class' => 'control-label m-b-5']) !!}

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
<!-- Switchery Checkbox -->
<link href="{{ asset('backend/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
<!-- Bootstrap Select -->
<link href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
<!-- Date and Time Pickers -->
<link href="{{ asset('backend/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
<!-- File Upload - Dropify -->
<link href="{{ asset('backend/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<!-- Bootstrap MaxLength -->
<script src="{{ asset('backend/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<!-- Switchery Checkbox -->
<script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>
<!-- Bootstrap Select -->
<script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<!-- Date and Time Pickers -->
<script src="{{ asset('backend/plugins/timepicker/bootstrap-timepicker.js') }}"></script>
<script src="{{ asset('backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('backend/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('backend/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<!-- File Upload - Dropify -->
<script src="{{ asset('backend/plugins/dropify/js/dropify.min.js') }}"></script>
<!-- Wysiwig Editor - TinyMCE -->
<script src="{{ asset('backend/plugins/tinymce/tinymce.min.js') }}"></script>

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

    // Bootstrap MaxLength
    $(".maxlength").maxlength({
        alwaysShow: true
    });

    // Date and Time Pickers
    $(".datepicker").datepicker({
        autoClose: true
    });
    $(".timepicker").timepicker({
        defaultTime: '10:00',
        showMeridian: false
    });
    $(".datetimepicker").datetimepicker();

    // Image Uploader
    var drEvent = $('.dropify').dropify(dropifyOptions);

    // Image delete
    drEvent.on('dropify.afterClear', function(event, element){
        $('#deleteImage').val(1);
    });



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

@push('scriptsBottom')
    @include('admin::tinymce-init', ['imagePath' => $page->getImageEditorPath()])
@endpush