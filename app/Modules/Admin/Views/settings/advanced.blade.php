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
            <h4 class="page-title">Настройки: виджеты</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="{{ route('admin.index') }}">Главная</a>
                </li>
                <li>
                    <a href="{{ route('admin.settings.index') }}">Настройки</a>
                </li>
                <li class="active">
                    Расширенные
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
        <a href="{{ route('admin.settings.index') }}" class="btn btn-default btn-rounded w-md waves-effect m-r-5">Общие настройки</a>
        <a href="{{ route('admin.settings.widgets') }}" class="btn btn-default btn-rounded w-md waves-effect m-r-5">Виджеты</a>
        <a href="{{ route('admin.settings.advanced') }}" class="btn btn-inverse btn-rounded w-md waves-effect m-r-5">Расширенные</a>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-lg-12">
        <!-- Расширенные настройки -->
        @if(isset($settings[\App\Models\Setting::CATEGORY_SITE]))
            <div class="card-box m-b-20">

                <h4 class="header-title m-t-0 m-b-20">Расширенные настройки</h4>
                <p class="text-muted font-13 m-b-15"></p>

                <table class="table table-bordered table-striped">
                    <tbody>
                    @foreach($settings[\App\Models\Setting::CATEGORY_SITE]['code'] as $key => $setting)
                        <tr>
                            <td width="25%">
                                <div>
                                    {{ $setting->title }}
                                    @if($setting->description)
                                        <p class="text-muted font-12 m-b-0">
                                            {{ $setting->description }}
                                        </p>
                                    @endif
                                </div>
                            </td>
                            <td width="60%">
                                <a href="#" class="editable-text" data-type="textarea" data-value="{{ $setting->value }}" data-pk="{{ $setting->id }}">{{ $setting->value }}</a>
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
</div>

@endsection