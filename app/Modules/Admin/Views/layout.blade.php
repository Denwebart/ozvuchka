<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8" />
    <title>Adminox - Responsive Web App Kit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.ico') }}">

    <!-- Toastr css -->
    <link href="{{ asset('backend/plugins/jquery-toastr/jquery.toast.min.css') }}" rel="stylesheet" />

    @stack('styles')

    <!-- C3 charts css -->
    <link href="{{ asset('backend/plugins/c3/c3.min.css') }}" rel="stylesheet" type="text/css"  />

    <!-- App css -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/menu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/responsive.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('backend/js/modernizr.min.js') }}"></script>

    <!-- Scripts Laravel -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body>

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <!--<a href="index.html" class="logo"><span>Code<span>Fox</span></span><i class="mdi mdi-layers"></i></a>-->
            <!-- Image logo -->
            <a href="{{ url('/') }}" class="logo">
                <span>
                    <img src="{{ asset('backend/images/logo.png') }}" alt="" height="25">
                </span>
                <i>
                    <img src="{{ asset('backend/images/logo_sm.png') }}" alt="" height="28">
                </i>
            </a>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">

                <!-- Navbar-left -->
                <ul class="nav navbar-nav navbar-left nav-menu-left">
                    <li>
                        <button type="button" class="button-menu-mobile open-left waves-effect">
                            <i class="dripicons-menu"></i>
                        </button>
                    </li>
                    <li class="dropdown hidden-xs mega-menu">
                        <a href="{{ url('/') }}" target="_blank" rel="nofollow noopener" class="waves-effect waves-light">Перейти на сайт</a>
                    </li>
                </ul>

                <!-- Right(Notification) -->
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden-xs">
                        <form role="search" class="app-search">
                            <input type="text" placeholder="Поиск..." class="form-control">
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                    <li>
                        <a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown">
                            <i class="dripicons-bell"></i>
                            <span class="badge badge-pink">4</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-lg user-list notify-list">
                            <li class="list-group notification-list m-b-0">
                                <div class="slimscroll">
                                    <!-- list item-->
                                    <a href="javascript:void(0);" class="list-group-item">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                                <em class="fa fa-diamond bg-primary"></em>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading text-primary">A new order has been placed A new order has been placed</h5>
                                                <p class="m-0">
                                                    There are new settings available
                                                </p>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- list item-->
                                    <a href="javascript:void(0);" class="list-group-item">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                                <em class="fa fa-cog bg-warning"></em>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading text-warning">New settings</h5>
                                                <p class="m-0">
                                                    There are new settings available
                                                </p>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- list item-->
                                    <a href="javascript:void(0);" class="list-group-item">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                                <em class="fa fa-bell-o bg-custom"></em>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading text-custom">Updates</h5>
                                                <p class="m-0">
                                                    There are <span class="text-primary font-600">2</span> new updates available
                                                </p>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- list item-->
                                    <a href="javascript:void(0);" class="list-group-item">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                                <em class="fa fa-user-plus bg-danger"></em>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading text-danger">New user registered</h5>
                                                <p class="m-0">
                                                    You have 10 unread messages
                                                </p>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- list item-->
                                    <a href="javascript:void(0);" class="list-group-item">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                                <em class="fa fa-diamond bg-primary"></em>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading text-primary">A new order has been placed A new order has been placed</h5>
                                                <p class="m-0">
                                                    There are new settings available
                                                </p>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- list item-->
                                    <a href="javascript:void(0);" class="list-group-item">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                                <em class="fa fa-cog bg-warning"></em>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading text-warning">New settings</h5>
                                                <p class="m-0">
                                                    There are new settings available
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <!-- end notification list -->
                        </ul>
                    </li>

                    <li class="dropdown user-box">
                        <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
                            <img src="{{ Auth::user()->getAvatarUrl() }}" alt="{{ Auth::user()->login }}" title="{{ Auth::user()->login }}" class="img-circle user-img">
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                            <li><a href="javascript:void(0)">Профиль</a></li>
                            <li><a href="javascript:void(0)">Настройки</a></li>
                            <li><a href="javascript:void(0)">Экран блокировки</a></li>
                            <li class="divider"></li>
                            <!-- Logout form -->
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                        </ul>
                    </li>

                </ul> <!-- end navbar-right -->

            </div><!-- end container -->
        </div><!-- end navbar -->
    </div>
    <!-- Top Bar End -->

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="slimscroll-menu" id="remove-scroll">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metisMenu nav" id="side-menu">
                    <li class="menu-title">Навигация</li>

                    <li>
                        <a href="{{ route('admin.index') }}">
                            <i class="fi-air-play"></i>
                            <span>Главная</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pages.index') }}" class="waves-effect @if(Request::is('admin/pages*')) active @endif">
                            <i class="fi-paper"></i>
                            <span>Страницы</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.gallery.index') }}" class="waves-effect @if(Request::is('admin/gallery*')) active @endif">
                            <i class="fi-camera "></i>
                            <span>Галерея</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.calls.index') }}" class="waves-effect @if(Request::is('admin/calls*')) active @endif">
                            <i class="fa fa-phone"></i>
                            <span>Звонки</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.letters.index') }}" class="waves-effect @if(Request::is('admin/letters*')) active @endif">
                            <i class="fi-mail"></i>
                            <span>Письма</span>
                        </a>
                    </li>

                    <li class="menu-title">More</li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="waves-effect @if(Request::is('admin/users*')) active @endif">
                            <i class="fi-head"></i>
                            <span>Пользователи</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settings.index') }}" class="waves-effect @if(Request::is('admin/settings*')) active @endif">
                            <i class="fi-cog"></i>
                            <span>Настройки</span>
                        </a>
                    </li>
                </ul>

            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                @yield('content')
            </div> <!-- container -->
        </div> <!-- content -->

        <footer class="footer text-right">
            2017 © Adminox. - Coderthemes.com
        </footer>

    </div>

    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

</div>
<!-- END wrapper -->

<!-- jQuery  -->
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('backend/js/waves.js') }}"></script>
<script src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>

<!-- Counter js  -->
<script src="{{ asset('backend/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('backend/plugins/counterup/jquery.counterup.min.js') }}"></script>

<!--C3 Chart-->
<script type="text/javascript" src="{{ asset('backend/plugins/d3/d3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/c3/c3.min.js') }}"></script>

<!--Echart Chart-->
<script src="{{ asset('backend/plugins/echart/echarts-all.js') }}"></script>

<!-- Dashboard init -->
<script src="{{ asset('backend/pages/jquery.dashboard.js') }}"></script>

<!-- Toastr js -->
<script src="{{ asset('backend/plugins/jquery-toastr/jquery.toast.min.js') }}" type="text/javascript"></script>

@stack('scripts')

<!-- App js -->
<script src="{{ asset('backend/js/jquery.core.js') }}"></script>
<script src="{{ asset('backend/js/jquery.app.js') }}"></script>

<script type="text/javascript">

    // Toastr js - Notifications
    function notification(text, status, params) {
        var options = {
            text: text,
            icon: status,
            loaderBg: "#1ea69a",
            position: "top-right",
            hideAfter: 3e3,
            stack: 1
        };

        switch(status) {
            case 'success':
                options['loaderBg'] = "#5ba035"; break;
            case 'error':
                options['loaderBg'] = "#bf441d"; break;
            case 'warning':
                options['loaderBg'] = "#da8609"; break;
            case 'info':
                options['loaderBg'] = "#3b98b5"; break;
        }

        if(params) {
            $.each(params, function (index, value) {
                options[index] = value;
            });
        }

        return $.toast(options);
    }

    // Notifications
    @if(Session::has('successMessage'))
        Command: notification('{{ Session::get('successMessage') }}', 'success');
    @endif
    @if(Session::has('errorMessage'))
        Command: notification('{{ Session::get('errorMessage') }}', 'error');
    @endif
    @if(Session::has('warningMessage'))
        Command: notification('{{ Session::get('warningMessage') }}', 'warning');
    @endif
    @if(Session::has('infoMessage'))
        Command: notification('{{ Session::get('infoMessage') }}', 'info');
    @endif

    // Merge json object
    function jsonMergeRecursive(json1, json2) {
        var out = {};
        for(var k1 in json1){
            if (json1.hasOwnProperty(k1)) out[k1] = json1[k1];
        }
        for(var k2 in json2){
            if (json2.hasOwnProperty(k2)) {
                if(!out.hasOwnProperty(k2)) out[k2] = json2[k2];
                else if(
                    (typeof out[k2] === 'object') && (out[k2].constructor === Object) &&
                    (typeof json2[k2] === 'object') && (json2[k2].constructor === Object)
                ) out[k2] = jsonMergeRecursive(out[k2], json2[k2]);
            }
        }
        return out;
    }

    // Dropify options
    var dropifyOptions = {
        messages: {
            'default': 'Кликните или перетащите файл.',
            'replace': 'Кликните или перетащите файл для замены.',
            'remove': 'Удалить',
            'error': 'Ошибка.'
        },
        error: {
            'fileSize': 'Размер файла слишком большой (максимум 3Мб).'
        }
    };
</script>

@stack('scriptsBottom')

</body>
</html>