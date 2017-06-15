<?php
/**
 * Page View
 *      (PagesController@getPage)
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
    <section class="intro intro-mini full-width jIntro bg-blog border-bottom" style="background-image: url({{ asset('frontend/images/backgrounds/pages-bg.jpg') }})" id="anchor00">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center not-found">
                        {{--<div class="primary-title">404</div>--}}
                        {{--<div class="subtitle-text">Страница не найдена</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PAGE TEXT -->
    <section class="section featured-shop not-found">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="page-content">
                        <div class="not-found-ptimary">404</div>
                        <div class="not-found-text">
                            <h2 class="title">Страница не найдена...</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection()