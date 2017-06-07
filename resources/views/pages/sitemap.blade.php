<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('layouts.app')

@section('content')
    <h1>{{ $page->title }}</h1>

    <ul id="sitemap">
        @foreach($sitemapItems as $item)
            <li>
                <a href="{{ $item->getUrl() }}">
                    <span>{{ $item->getTitle() }}</span>
                </a>
                {{ \App\Helpers\View::getChildrenPages($item, $item->getUrl()) }}
            </li>
        @endforeach
    </ul>
@endsection()