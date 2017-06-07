<?php
/**
 * Main Page View
 *      (PagesController@index)
 *
 * Variables:
 *      $page - object App\Models\Page
 *
 * Output slider, etc.
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('layouts.app')

@section('content')
    <h1>{{ $page->title }}</h1>

    <h2>Слайдер</h2>
    {!! $slider->show() !!}
@endsection()