<?php
/**
 * Category Page View
 *      (PagesController@getCategoryPage)
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

    @foreach($articles as $article)
        <div>
            <img src="{{ $article->getImageUrl() }}" alt="{{ $article->image_alt }}">
            <h2>{{ $article->title }}</h2>
            <p>{{ $article->getIntrotext() }}</p>
            <p>{{ \App\Helpers\Date::format($article->published_at) }}</p>
            <a href="{{ $article->getUrl() }}">Читать далее</a>
        </div>
    @endforeach()
@endsection()