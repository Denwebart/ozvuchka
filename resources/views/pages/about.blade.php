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
    <section class="intro intro-mini full-width jIntro bg-blog"  style="background-image: url({{ asset('frontend/images/backgrounds/about.jpg') }})" id="anchor00">
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

    <!-- BIOGRAPHY -->
    <section class="section biography" id="anchor03">
        <div class="container">
            <div class="voffset80"></div>
            <div class="row">
                <div class="col-lg-6">
                    <img src="{{ $page->getImageUrl() }}" alt="{{ $page->image_alt }}">
                </div>
                <div class="col-lg-6">
                    <div class="voffset50"></div>
                    <div class="quote">
                        <p>"Какая-нибудь красивая цитата, отражающая работу команды."</p>
                        <p class="author">Роман Ракитянский</p>
                    </div>
                    <div class="description">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- OUR TEAM -->
    {!! $teamMembers->show() !!}
@endsection()