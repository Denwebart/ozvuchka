<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="{{ config('app.locale') }}"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="{{ config('app.locale') }}"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="{{ config('app.locale') }}"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="{{ config('app.locale') }}"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>{{ $page->getMetaTitle() }}</title>
    <meta name="description" content="{{ $page->getMetaDesc() }}">
    <meta name="keywords" content="{{ $page->getMetaKey() }}">

    @if(isset($siteSettings['meta']))
        @if(isset($siteSettings['meta']['author']) && is_object($siteSettings['meta']['author']))
            <meta name="author" lang="ru" content="{{ $siteSettings['meta']['author']->value }}">
        @endif
        @if(isset($siteSettings['meta']['copyright']) && is_object($siteSettings['meta']['copyright']))
            <meta name="copyright" lang="ru" content="{{ $siteSettings['meta']['copyright']->value }}" />
        @endif
    @else
        @if(Config::get('settings.metaCopyright'))
            <meta name="copyright" lang="ru" content="{{ Config::get('settings.metaCopyright') }}">
        @endif
        @if(Config::get('settings.metaAuthor'))
            <meta name="author" lang="ru" content="{{ Config::get('settings.metaAuthor') }}">
        @endif
    @endif
    @if(isset($metaRobots))
        <meta name="robots" content="{{ $metaRobots }}">
    @else
        @if(isset($siteSettings['meta']['robots']) && is_object($siteSettings['meta']['robots']))
            <meta name="robots" content="{{ $siteSettings['meta']['robots']->value }}" />
        @else
            <meta name="robots" content="{{ Config::get('settings.metaRobots', 'noindex,nofollow') }}">
        @endif
    @endif

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="stylesheet" href="{{ asset('frontend/styles/main.css') }}">

    <script src="{{ asset('frontend/scripts/vendor/modernizr.js') }}"></script>

    @stack('styles')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body data-spy="scroll" data-target="#navbar-muziq" data-offset="80">

<!-- LOADER -->
<div id="mask">
    <div class="loader">
        <!-- <img src="{{ asset('frontend/images/loading.gif') }}" alt='loading'> -->
        <div class="cssload-container">
            <div class="cssload-shaft1"></div>
            <div class="cssload-shaft2"></div>
            <div class="cssload-shaft3"></div>
            <div class="cssload-shaft4"></div>
            <div class="cssload-shaft5"></div>
            <div class="cssload-shaft6"></div>
            <div class="cssload-shaft7"></div>
            <div class="cssload-shaft8"></div>
            <div class="cssload-shaft9"></div>
            <div class="cssload-shaft10"></div>
        </div>
    </div>
</div>

<!-- HEADER -->
<header id="jHeader">
    <nav class="navbar navbar-default" role="navigation">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Меню</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo" href="{{ url('/') }}"><img src="{{ asset('images/logo_dark.svg') }}" alt="@if(isset($siteSettings['siteTitle'])) {{ $siteSettings['siteTitle'] }} @else {{ Config::get('settings.domain') }} @endif"></a>
            <a class="navbar-brand logo-sm" href="{{ url('/') }}"><img src="{{ asset('images/logo_dark_sm.svg') }}" alt="@if(isset($siteSettings['siteTitle'])) {{ $siteSettings['siteTitle'] }} @else {{ Config::get('settings.domain') }} @endif"></a>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse" id="navbar-muziq">
            <ul class="nav navbar-nav navbar-right">
                {!! $menuWidget->main() !!}
            </ul>
        </div>
    </nav>
</header>

@yield('content')

<!-- FOOTER -->
<footer>
    <div class="container">
        <p class="copy">
            <span class="without-enter">
                ©
                <a href="{{ url('/') }}"><span>{{ Config::get('settings.domain', url('/')) }}</span></a>
                @if(Config::get('settings.startupYear', date('Y')) != date('Y'))
                {{ Config::get('settings.startupYear', date('Y')) }} -
                @endif
                {{ date('Y') }}.
            </span>
            @if(isset($siteSettings['copyright']) && is_object($siteSettings['copyright']))
                <span>{!! $siteSettings['copyright']->value !!}</span>
            @endif
        </p>

        <p class="created-by">
            Разработано студией
            <a href="http://it-hill.com">
                <span>IT Hill</span>
                <img src="{{ asset('frontend/images/it-hill_logo.svg') }}" alt="Студия создания сайтов IT Hill" title="Студия создания сайтов IT Hill">
            </a>
        </p>
    </div>
</footer>

<!--[if lt IE 7]>
<p class="browsehappy">
    Вы пользуетесь <strong>устаревшей</strong> версией браузера Internet Explorer.
    Данная версия браузера не поддерживает многие современные технологии,
    из-за чего многие страницы отображаются некорректно,
    а главное — на сайтах могут работать не все функции.
    <br>
    Советуем <a href="http://browsehappy.com/">обновить</a> браузер
    до более поздней версии или воспользоваться другим браузером.
</p>
<![endif]-->

<script src="{{ asset('frontend/scripts/plugins.js') }}"></script>

<script src="{{ asset('frontend/scripts/main.js') }}"></script>

<script src="{{ asset('frontend/scripts/colorpicker.js') }}"></script>

<script src="{{ asset('frontend/scripts/vendor/bootstrap.js') }}"></script>

<script type="text/javascript">
    $(document).on('click', '.link-to', function (e) {
        var target = $(this).data('linkTo');
        $('html, body').animate({
            scrollTop: $('#' + target).offset().top
        }, 1000);
    });
</script>

@stack('scripts')

</body>
</html>

<!---------------------------------------------------------------------->

{{--{!! $requestedCallsWidget->show() !!}--}}