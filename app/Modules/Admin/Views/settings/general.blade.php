<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('admin::settings.index')

@section('settingsContent')

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

<!-- Settings menu -->
<div class="row">
    <div class="col-xs-12 m-b-20">
        <a href="{{ route('admin.settings.index') }}" class="btn btn-inverse btn-rounded w-md waves-effect m-r-5">Общие настройки</a>
        <a href="{{ route('admin.settings.widgets') }}" class="btn btn-default btn-rounded w-md waves-effect m-r-5">Виджеты</a>
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
                                        {!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'class' => 'ajax-checkbox', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->id]) !!}
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
                                        {!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'class' => 'ajax-checkbox', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->id]) !!}
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
                {{--{!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'class' => 'ajax-checkbox', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}--}}
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
                                        {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'class' => 'ajax-checkbox', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
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
                                        {{--{!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'class' => 'ajax-checkbox', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}--}}
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
                                            {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'class' => 'ajax-checkbox', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
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
                                        {{--{!! Form::checkbox('value', 1, $setting->value, ['id' => 'value', 'data-plugin' => 'switchery', 'class' => 'ajax-checkbox', 'data-url' => route('admin.settings.setValue'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}--}}
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
        @include('admin::menus.index')
    </div><!-- end col -->
</div>

@endsection