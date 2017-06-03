<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('admin::layout')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Настройки</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="{{ route('admin.index') }}">Главная</a>
                </li>
                <li class="active">
                    Настройки
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-lg-6">

        <!-- Общая информация -->
        @if(isset($settings[\App\Models\Setting::CATEGORY_SITE]))
            <div class="card-box m-b-20">

                <h4 class="header-title m-t-0 m-b-20">Общая информация</h4>
                <p class="text-muted font-13 m-b-15"></p>

                <table class="table table-bordered table-striped">
                    <tbody>
                        <!-- siteTitle -->
                        @if(isset($settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']))
                            <tr>
                                <td width="25%">
                                    {{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->title }}
                                    @if($settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->description)
                                        <p class="text-muted font-12 m-b-0">
                                            {{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->description }}
                                        </p>
                                    @endif
                                </td>
                                <td width="60%">
                                    <a href="#" class="editable-text" data-type="textarea" data-value="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->value }}" data-pk="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->id }}" data-title="Введите заголовок сайта">{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->value }}</a>
                                </td>
                                <td width="15%">
                                    <div class="switchery-demo">
                                        {!! Form::hidden('is_active', 0) !!}
                                        {!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->id]) !!}
                                    </div>
                                </td>
                            </tr>
                        @endif

                        <!-- copyright -->
                        @if(isset($settings[\App\Models\Setting::CATEGORY_SITE]['copyright']))
                            <tr>
                                <td width="25%">
                                    {{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->title }}
                                    @if($settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->description)
                                        <p class="text-muted font-12 m-b-0">
                                            {{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->description }}
                                        </p>
                                    @endif
                                </td>
                                <td width="60%">
                                    <a href="#" class="editable-text" data-type="textarea" data-value="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->value }}" data-pk="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->id }}">{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->value }}</a>
                                </td>
                                <td width="15%">
                                    <div class="switchery-demo">
                                        {!! Form::hidden('is_active', 0) !!}
                                        {!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->id]) !!}
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                {{--{!! Form::open(['files' => true]) !!}--}}
                {{--@foreach($settings[\App\Models\Setting::CATEGORY_SITE]['logo'] as $key => $setting)--}}
                {{--<div class="form-group settings image-container @if($key != 'main') dark @endif" data-image-setting-id="{{ $setting->id }}">--}}
                {{--<label class="col-md-3 col-sm-3 control-label">--}}
                {{--{{ $setting->title }}--}}
                {{--@if($setting->description)--}}
                {{--<small>{{ $setting->description }}</small>--}}
                {{--@endif--}}
                {{--</label>--}}
                {{--<div class="col-md-7 col-sm-7">--}}
                {{--{!! Form::file('logo.' . $key, ['id' => 'logo.' . $key, 'class' => 'dropify-ajax', 'data-height' => '100', 'data-default-file' => ($setting->value) ? $setting->getImageUrl() : '', 'data-max-file-size' => '3M', 'data-setting-id' => $setting->id, 'data-delete-url' => route('admin.settings.deleteImage'), 'data-upload-url' => route('admin.settings.uploadImage')]) !!}--}}
                {{--<span class="error help-block text-danger font-12">
            <i class="fa fa-times-circle"></i>--}}
                {{--<strong class="text"></strong>--}}
                {{--</span>--}}
                {{--</div>--}}
                {{--<div class="col-md-2 col-sm-2">--}}
                {{--<div class="switchery-demo">--}}
                {{--{!! Form::hidden('is_active', 0) !!}--}}
                {{--{!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--@endforeach--}}
                {{--{!! Form::close() !!}--}}
            </div>
        @endif

        <!-- Социальные сети -->
        @if(isset($settings[\App\Models\Setting::CATEGORY_SITE]['socialLinks']))
            <div class="card-box m-b-20">

                <h4 class="header-title m-t-0 m-b-20">Социальные сети</h4>
                <p class="text-muted font-13 m-b-15">
                    Ссылки на группу или страницу в социальных сетях.
                </p>

                <table class="table table-bordered table-striped">
                    <tbody>
                        @foreach($settings[\App\Models\Setting::CATEGORY_SITE]['socialLinks'] as $key => $setting)
                            <tr>
                                <td width="25%">
                                    <div>
                                        <i class="fa fa-{{ $key }}"></i>
                                        {{ $setting->title }}
                                    </div>
                                </td>
                                <td width="60%">
                                    <a href="#" class="editable-text" data-type="text" data-value="{{ $setting->value }}" data-pk="{{ $setting->id }}" data-title="Введите ссылку">{{ $setting->value }}</a>
                                </td>
                                <td width="15%">
                                    <div class="switchery-demo">
                                        {!! Form::hidden('is_active', 0) !!}
                                        {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Контактная информация -->
        @if(isset($settings[\App\Models\Setting::CATEGORY_CONTACT_PAGE]))
            <div class="card-box m-b-20">

                <!-- Общая контактная информация -->
                <h4 class="header-title m-t-0 m-b-20">Контактная информация</h4>
                <p class="text-muted font-13 m-b-15">
                    Контактная информация, которая будет отображена на сайте.
                </p>

                <table class="table table-bordered table-striped">
                    <tbody>
                        {{--@foreach($settings[\App\Models\Setting::CATEGORY_SITE]['contactInfo'] as $key => $setting)--}}
                            {{--<tr>--}}
                                {{--<td width="25%">--}}
                                    {{--<div title="{{ $setting->description }}" data-toggle="tooltip">--}}
                                        {{--<i class="fa fa-{{ \App\Models\Setting::$contactInfoIcons[$key] }}"></i>--}}
                                        {{--{{ $setting->title }}--}}
                                        {{--@if($setting->description)--}}
                                            {{--<p class="text-muted font-12 m-b-0">{{ $setting->description }}</p>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td width="60%">--}}
                                    {{--<a href="#" class="editable-text" @if($setting->type == \App\Models\Setting::TYPE_TEXT) data-type="textarea" @else data-type="text" @endif data-value="{{ $setting->value }}" data-pk="{{ $setting->id }}" data-title="Введите значение">{{ $setting->value }}</a>--}}
                                {{--</td>--}}
                                {{--<td width="15%">--}}
                                    {{--<div class="switchery-demo">--}}
                                        {{--{!! Form::hidden('is_active', 0) !!}--}}
                                        {{--{!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                    </tbody>
                </table>

                @if(isset($settings[\App\Models\Setting::CATEGORY_CONTACT_PAGE]['map']))
                    <!-- Координаты на карте -->
                    <h5 class="header-title m-t-20 m-b-10"><b>Координаты на карте</b></h5>
                    <p class="text-muted font-13 m-b-15">
                        Карта будет отображена на странице с контактами только в том случае,
                        если заполнены и включены обе настройки.
                    </p>

                    <table class="table table-bordered table-striped">
                        <tbody>
                            @foreach($settings[\App\Models\Setting::CATEGORY_CONTACT_PAGE]['map'] as $key => $setting)
                                <tr>
                                    <td width="25%">
                                        <div>
                                            {{ $setting->title }}
                                            @if($setting->description)
                                                <p class="text-muted font-12 m-b-0">{{ $setting->description }}</p>
                                            @endif
                                        </div>
                                    </td>
                                    <td width="60%">
                                        <a href="#" class="editable-text" data-type="text" data-value="{{ $setting->value }}" data-pk="{{ $setting->id }}" data-title="Введите значение">{{ $setting->value }}</a>
                                    </td>
                                    <td width="15%">
                                        <div class="switchery-demo">
                                            {!! Form::hidden('is_active', 0) !!}
                                            {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @endif

        <!-- Системные настройки -->
        @if(isset($settings[\App\Models\Setting::CATEGORY_SYSTEM]))
            <div class="card-box m-b-20">

                <h4 class="header-title m-t-0 m-b-20">Системные настройки</h4>
                <p class="text-muted font-13 m-b-15"></p>

                <table class="table table-bordered table-striped">
                    <tbody>
                        {{--@foreach($settings[\App\Models\Setting::CATEGORY_SYSTEM]['premoderation'] as $key => $setting)--}}
                            {{--<tr>--}}
                                {{--<td width="25%">--}}
                                    {{--<div title="{{ $setting->description }}" data-toggle="tooltip">--}}
                                        {{--{{ $setting->title }}--}}
                                        {{--@if($setting->description)--}}
                                            {{--<p class="text-muted font-12 m-b-0">{{ $setting->description }}</p>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td width="75%">--}}
                                    {{--<div class="switchery-demo">--}}
                                        {{--{!! Form::hidden('value', 0) !!}--}}
                                        {{--{!! Form::checkbox('value', 1, $setting->value, ['id' => 'value', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setValue'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <div class="col-lg-6">
        @include('admin::menus.menu')

        @include('admin::slider.slider')
    </div><!-- end col -->
</div>

@endsection

@push('styles')
<!-- Switchery -->
<link rel="stylesheet" href="{{ asset('backend/plugins/switchery/switchery.min.css') }}">
<!-- X editable -->
<link href="{{ asset('backend/plugins/bootstrap-xeditable/css/bootstrap-editable.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<!-- Switchery -->
<script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>
<!-- Xeditable -->
<script src="{{ asset('backend/plugins/moment/moment.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/plugins/bootstrap-xeditable/js/bootstrap-editable.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/pages/jquery.xeditable.init.js') }}" type="text/javascript"></script>
@endpush

@push('scriptsBottom')
<!-- Xeditable -->
<script type="text/javascript">
    //modify Xeditable style
    $.fn.editableform.buttons =
        '<button type="submit" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="zmdi zmdi-check"></i></button>' +
        '<button type="button" class="btn editable-cancel btn-sm waves-effect"><i class="zmdi zmdi-close"></i></button>';

    $.fn.editableform.template =
        '<form class="form-inline editableform"><div class="control-group"><div><div class="editable-input"></div><div class="editable-buttons"></div></div><span class="error help-block text-danger font-12"><strong class="editable-error-block"></strong></span></div></form>';

    $.fn.editableform.defaults.params = function (params) {
        params._token = $("meta[name='csrf-token']").attr('content');
        return params;
    };

    // Edit settings
    function getSettingsEditableOptions() {
        return {
            url: "{{ route('admin.settings.setValue') }}",
            mode: 'inline',
            prepend: false,
            emptytext: 'не задано',
            ajaxOptions: {
                dataType: 'json',
                sourceCache: 'false',
                type: 'POST'
            },
            success: function(response, newValue) {
                if(response.success) {
                    notification(response.message, 'success');
                    return true;
                } else {
                    notification(response.message, 'error');
                    return response.error;
                }
                return false;
            }
        }
    }
    $('.editable-text').editable(getSettingsEditableOptions());

    // Change active status or boolean value
    $('[data-plugin=switchery], .ajax-checkbox').on('change', function (e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var value = 0;
        if($(this).is(':checked')) {
            value = 1;
        }
        var url = $(this).data('url') ? $(this).data('url') : "{{ route('admin.settings.setIsActive') }}";
        $.ajax({
            url: url,
            dataType: "text json",
            type: "POST",
            data: {id: $(this).data('id'), value: value, name: $(this).attr('name')},
            beforeSend: function(request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response) {
                if(response.success){
                    notification(response.message, 'success');
                } else {
                    notification(response.message, 'error');
                }
            }
        });
    });
</script>
@endpush