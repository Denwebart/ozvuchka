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
        <a href="{{ route('admin.settings.advanced') }}" class="btn btn-default btn-rounded w-md waves-effect m-r-5">Расширенные</a>
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

                @if(isset($settings[\App\Models\Setting::CATEGORY_SITE]['socialLinks']))
                    <!-- Мета-данные -->
                    <h4 class="header-title m-t-0 m-b-20">Мета-теги</h4>
                    <p class="text-muted font-13 m-b-15">
                        Предназначены исключительно для поисковых систем.
                        Не отображаются на страницах сайта.
                    </p>

                    <table class="table table-bordered table-striped">
                        <tbody>
                            @foreach($settings[\App\Models\Setting::CATEGORY_SITE]['meta'] as $key => $setting)
                                @if(in_array($key, ['robots','author','copyright']))
                                    <tr>
                                        <td width="25%">
                                            {{ $setting->title }}
                                            <!-- Info text: metadata -->
                                            <span class="m-l-10 text-muted help-popover" data-container="body" title="" data-toggle="popover" data-trigger="hover" data-placement="right" tabindex="0" data-html="true" data-content="{{ $setting->description }}" data-original-title="{{ $setting->title }}">
                                                <i class="fa fa-question-circle-o"></i>
                                            </span>
                                        </td>
                                        <td width="60%">
                                            <a href="#" class="editable-text" data-value="{{ $setting->value }}" @if($key == 'robots') data-type="text" @else data-type="textarea" @endif data-pk="{{ $setting->id }}">{{ $setting->value }}</a>
                                        </td>
                                        <td width="15%">
                                            <div class="switchery-demo">
                                                {!! Form::hidden('is_active', 0) !!}
                                                {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'class' => 'ajax-checkbox', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @endif

        <!-- Социальные сети -->
        @if(isset($settings[\App\Models\Setting::CATEGORY_SITE]) && isset($settings[\App\Models\Setting::CATEGORY_SITE]['socialLinks']))
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
        @if(1 == 0 && isset($settings[\App\Models\Setting::CATEGORY_CONTACT_PAGE]))
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

                @if(1 == 0 && isset($settings[\App\Models\Setting::CATEGORY_CONTACT_PAGE]['map']))
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

    </div>
    <div class="col-lg-6">
        @include('admin::menus.index')
    </div><!-- end col -->
</div>

@endsection