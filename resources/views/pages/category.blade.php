<?php
/**
 * Category Page View
 *
 * Variables:
 *      $page - object App\Models\Page
 *      $pages - collection with pages object App\Models\Page
 *
 * Output child pages.
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('layouts.app')

@section('content')
    <h1>{{ $page->title }}</h1>
@endsection()