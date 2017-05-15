<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
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

{{--<div class="row">--}}
    {{--<div class="col-lg-6">--}}
        {{--<div class="card-box">--}}

            {{--<h4 class="header-title m-t-0 m-b-10"><b>Общая информация</b></h4>--}}

            {{--<p class="text-muted font-13 m-b-15"></p>--}}

            {{--<div class="form-horizontal form-editable">--}}
                {{--<div class="form-group">--}}
                    {{--<label class="col-md-3 col-sm-3 control-label">--}}
                        {{--{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->title }}--}}
                        {{--@if($settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->description)--}}
                            {{--<small>{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->description }}</small>--}}
                        {{--@endif--}}
                    {{--</label>--}}
                    {{--<div class="col-md-7 col-sm-7">--}}
                        {{--<a href="#" class="editable-text" data-value="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->value }}" data-type="textarea" data-pk="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->id }}">{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->value }}</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-2 col-sm-2">--}}
                        {{--<div class="switchery-demo">--}}
                            {{--{!! Form::hidden('is_active', 0) !!}--}}
                            {{--{!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->id]) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group">--}}
                    {{--<label class="col-md-3 col-sm-3 control-label">--}}
                        {{--{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->title }}--}}
                        {{--@if($settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->description)--}}
                            {{--<small>{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->description }}</small>--}}
                        {{--@endif--}}
                    {{--</label>--}}
                    {{--<div class="col-md-7 col-sm-7">--}}
                        {{--<a href="#" class="editable-text" data-value="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->value }}" data-type="textarea" data-pk="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->id }}">{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->value }}</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-2 col-sm-2">--}}
                        {{--<div class="switchery-demo">--}}
                            {{--{!! Form::hidden('is_active', 0) !!}--}}
                            {{--{!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->id]) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group">--}}
                    {{--<label class="col-md-3 col-sm-3 control-label">--}}
                        {{--{{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->title }}--}}
                        {{--@if($settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->description)--}}
                            {{--<small>{{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->description }}</small>--}}
                        {{--@endif--}}
                    {{--</label>--}}
                    {{--<div class="col-md-7 col-sm-7">--}}
                        {{--<a href="#" class="editable-text" data-value="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->value }}" data-type="textarea" data-pk="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->id }}">{{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->value }}</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-2 col-sm-2">--}}
                        {{--<div class="switchery-demo">--}}
                            {{--{!! Form::hidden('is_active', 0) !!}--}}
                            {{--{!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->id]) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

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
                            {{--<span class="help-block error">--}}
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

            {{--<!-- Мета-данные -->--}}
                {{--<h4 class="header-title m-t-0 m-b-10"><b>Мета-теги</b></h4>--}}
                {{--<p class="text-muted font-13 m-b-15">--}}
                    {{--Предназначены исключительно для поисковых систем.--}}
                    {{--Не отображаются на страницах сайта. <br>--}}
                {{--</p>--}}
                {{--<div class="form-horizontal form-editable">--}}
                    {{--@foreach($settings[\App\Models\Setting::CATEGORY_SITE]['meta'] as $key => $setting)--}}
                        {{--@if(in_array($key, ['robots','author','copyright']))--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-3 col-sm-3 control-label" title="{{ $setting->description }}" data-toggle="tooltip">--}}
                                    {{--{{ $setting->title }}--}}
                                {{--</label>--}}
                                {{--<div class="col-md-7 col-sm-7">--}}
                                    {{--<a href="#" class="editable-text" data-value="{{ $setting->value }}" @if($key == 'robots') data-type="text" @else data-type="textarea" @endif data-pk="{{ $setting->id }}">{{ $setting->value }}</a>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-2 col-sm-2">--}}
                                    {{--<div class="switchery-demo">--}}
                                        {{--{!! Form::hidden('is_active', 0) !!}--}}
                                        {{--{!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endif--}}
                    {{--@endforeach--}}
                {{--</div>--}}
                {{--<p class="text-muted font-13 m-b-15">--}}
                {{--Мета-теги title, description, keywords будут использованы в том случае,--}}
                {{--если мета-данные страницы не будут заполнены.<br>--}}
                {{--</p>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="card-box">--}}

            {{--<h4 class="header-title m-t-0 m-b-10"><b>Социальные сети</b></h4>--}}

            {{--<p class="text-muted font-13 m-b-15">--}}
                {{--Ссылки на группу или страницу в социальных сетях.--}}
            {{--</p>--}}

            {{--<div class="form-horizontal form-editable">--}}
                {{--@foreach($settings[\App\Models\Setting::CATEGORY_SITE]['socialButtons'] as $key => $setting)--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-3 col-sm-3 control-label" title="{{ $setting->description }}" data-toggle="tooltip">--}}
                            {{--<i class="fa fa-{{ $key }}"></i>--}}
                            {{--{{ $setting->title }}--}}
                        {{--</label>--}}
                        {{--<div class="col-md-7 col-sm-7">--}}
                            {{--<a href="#" class="editable-text" data-value="{{ $setting->value }}" data-type="text" data-pk="{{ $setting->id }}">--}}
                                {{--{{ $setting->value }}--}}
                            {{--</a>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2 col-sm-2">--}}
                            {{--<div class="switchery-demo">--}}
                                {{--{!! Form::hidden('is_active', 0) !!}--}}
                                {{--{!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="card-box">--}}

            {{--<h4 class="header-title m-t-0 m-b-10"><b>Контактная информация</b></h4>--}}

            {{--<p class="text-muted font-13 m-b-15">--}}
                {{--Контактная информация, которая будет отображена на сайте.--}}
            {{--</p>--}}

            {{--<div class="form-horizontal form-editable">--}}
                {{--@foreach($settings[\App\Models\Setting::CATEGORY_SITE]['contactInfo'] as $key => $setting)--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-3 col-sm-3 control-label">--}}
                            {{--<i class="fa fa-{{ \App\Models\Setting::$contactInfoIcons[$key] }}"></i>--}}
                            {{--{{ $setting->title }}--}}
                            {{--@if($setting->description)--}}
                                {{--<small>{{ $setting->description }}</small>--}}
                            {{--@endif--}}
                        {{--</label>--}}
                        {{--<div class="col-md-7 col-sm-7">--}}
                            {{--<a href="#" class="editable-text" data-value="{{ $setting->value }}" @if($setting->type == \App\Models\Setting::TYPE_TEXT) data-type="textarea" @else data-type="text" @endif data-pk="{{ $setting->id }}">{{ $setting->value }}</a>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2 col-sm-2">--}}
                            {{--<div class="switchery-demo">--}}
                                {{--{!! Form::hidden('is_active', 0) !!}--}}
                                {{--{!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}

            {{--<h5 class="header-title m-t-20 m-b-10"><b>Координаты на карте</b></h5>--}}
            {{--<p class="text-muted font-13 m-b-15">--}}
                {{--Карта будет отображена на странице с контактами только в том случае,--}}
                {{--если заполнены и включены обе настройки.--}}
            {{--</p>--}}

            {{--<div class="form-horizontal form-editable">--}}
                {{--@foreach($settings[\App\Models\Setting::CATEGORY_CONTACT_PAGE]['map'] as $key => $setting)--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-3 col-sm-3 control-label">--}}
                            {{--{{ $setting->title }}--}}
                        {{--</label>--}}
                        {{--<div class="col-md-7 col-sm-7">--}}
                            {{--<a href="#" class="editable-text" data-value="{{ $setting->value }}" data-type="text" data-pk="{{ $setting->id }}">{{ $setting->value }}</a>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2 col-sm-2">--}}
                            {{--<div class="switchery-demo">--}}
                                {{--{!! Form::hidden('is_active', 0) !!}--}}
                                {{--{!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="card-box">--}}

            {{--<h4 class="header-title m-t-0 m-b-10"><b>Системные настроки</b></h4>--}}

            {{--<p class="text-muted font-13 m-b-15">--}}

            {{--</p>--}}

            {{--<div class="form-horizontal form-editable">--}}
                {{--@foreach($settings[\App\Models\Setting::CATEGORY_SYSTEM]['premoderation'] as $key => $setting)--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-10 col-sm-10 control-label">--}}
                            {{--{{ $setting->title }}--}}
                            {{--@if($setting->description)--}}
                                {{--<small>{{ $setting->description }}</small>--}}
                            {{--@endif--}}
                        {{--</label>--}}
                        {{--<div class="col-md-2 col-sm-2">--}}
                            {{--<div class="switchery-demo">--}}
                                {{--{!! Form::hidden('value', 0) !!}--}}
                                {{--{!! Form::checkbox('value', 1, $setting->value, ['id' => 'value', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setValue'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-lg-6">--}}
        {{--<div class="card-box">--}}
            {{--@include('admin::menus.menu')--}}
        {{--</div>--}}
    {{--</div><!-- end col -->--}}
{{--</div>--}}

@endsection