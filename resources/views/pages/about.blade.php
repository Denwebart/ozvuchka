<?php
/**
 * "About" Page View
 *      (PagesController@getAboutPage)
 *
 * Variables:
 *      $page - object App\Models\Page
 *
 * Output page info.
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('layouts.app')

@section('content')
    <!-- INTRO -->
    <section class="intro intro-mini full-width jIntro bg-blog border-bottom"  style="background-image: url({{ asset('frontend/images/backgrounds/about-bg.jpg') }})" id="anchor00">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1 class="primary-title">{{ $page->getTitle() }}</h1>
                        {{--<h2 class="subtitle-text">Кто мы и чем занимаемся</h2>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section class="section" id="anchor03">
        <div class="container">
            @if($page->title)
                <div class="voffset50"></div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="title">{{ $page->title }}</h2>
                    </div>
                </div>
            @endif
            @if($page->content || $page->getImageUrl())
                <div class="row">
                    <div class="col-md-12">
                        <div class="voffset50"></div>
                        <div class="page-content">
                            @if($page->getImageUrl())
                                <img src="{{ $page->getImageUrl('full') }}" alt="{{ $page->image_alt }}" title="{{ $page->image_alt }}" width="50%" class="pull-left m-r-50 m-b-20">
                            @endif
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- OUR TEAM -->
    {!! $teamMembers->show() !!}
@endsection()