<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.ico') }}">

    <title>Adminto - Responsive Admin Dashboard Template</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/morris/morris.css') }}">

    <!-- App css -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/menu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/responsive.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{ asset('backend/js/modernizr.min.js') }}"></script>
</head>


<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <a href="/backend/html/index.html" class="logo"><span>Admin<span>to</span></span><i class="zmdi zmdi-layers"></i></a>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">

                <!-- Page title -->
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <button class="button-menu-mobile open-left">
                            <i class="zmdi zmdi-menu"></i>
                        </button>
                    </li>
                    <li>
                        <h4 class="page-title">Dashboard</h4>
                    </li>
                </ul>

                <!-- Right(Notification and Searchbox -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <!-- Notification -->
                        <div class="notification-box">
                            <ul class="list-inline m-b-0">
                                <li>
                                    <a href="javascript:void(0);" class="right-bar-toggle">
                                        <i class="zmdi zmdi-notifications-none"></i>
                                    </a>
                                    <div class="noti-dot">
                                        <span class="dot"></span>
                                        <span class="pulse"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- End Notification bar -->
                    </li>
                    <li class="hidden-xs">
                        <form role="search" class="app-search">
                            <input type="text" placeholder="Search..."
                                   class="form-control">
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                </ul>

            </div><!-- end container -->
        </div><!-- end navbar -->
    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">

            <!-- User -->
            <div class="user-box">
                <div class="user-img">
                    <img src="{{ asset('backend/images/users/avatar-1.jpg') }}" alt="user-img" title="Mat Helme" class="img-circle img-thumbnail img-responsive">
                    <div class="user-status offline"><i class="zmdi zmdi-dot-circle"></i></div>
                </div>
                <h5><a href="#">Mat Helme</a> </h5>
                <ul class="list-inline">
                    <li>
                        <a href="#" >
                            <i class="zmdi zmdi-settings"></i>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="text-custom">
                            <i class="zmdi zmdi-power"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End User -->

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul>
                    <li class="text-muted menu-title">Navigation</li>

                    <li>
                        <a href="/backend/html/index.html" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
                    </li>

                    <li>
                        <a href="/backend/html/typography.html" class="waves-effect"><i class="zmdi zmdi-format-underlined"></i> <span> Typography </span> </a>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-invert-colors"></i> <span> User Interface </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="/backend/html/ui-buttons.html">Buttons</a></li>
                            <li><a href="/backend/html/ui-cards.html">Cards</a></li>
                            <li><a href="/backend/html/ui-draggable-cards.html">Draggable Cards</a></li>
                            <li><a href="/backend/html/ui-checkbox-radio.html">Checkboxs-Radios</a></li>
                            <li><a href="/backend/html/ui-material-icons.html">Material Design Icons</a></li>
                            <li><a href="/backend/html/ui-font-awesome-icons.html">Font Awesome</a></li>
                            <li><a href="/backend/html/ui-dripicons.html">Dripicons</a></li>
                            <li><a href="/backend/html/ui-themify-icons.html">Themify Icons</a></li>
                            <li><a href="/backend/html/ui-modals.html">Modals</a></li>
                            <li><a href="/backend/html/ui-notification.html">Notification</a></li>
                            <li><a href="/backend/html/ui-range-slider.html">Range Slider</a></li>
                            <li><a href="/backend/html/ui-components.html">Components</a>
                            <li><a href="/backend/html/ui-sweetalert.html">Sweet Alert</a>
                            <li><a href="/backend/html/ui-treeview.html">Tree view</a>
                            <li><a href="/backend/html/ui-widgets.html">Widgets</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-collection-text"></i><span class="label label-warning pull-right">7</span><span> Forms </span> </a>
                        <ul class="list-unstyled">
                            <li><a href="/backend/html/form-elements.html">General Elements</a></li>
                            <li><a href="/backend/html/form-advanced.html">Advanced Form</a></li>
                            <li><a href="/backend/html/form-validation.html">Form Validation</a></li>
                            <li><a href="/backend/html/form-wizard.html">Form Wizard</a></li>
                            <li><a href="/backend/html/form-fileupload.html">Form Uploads</a></li>
                            <li><a href="/backend/html/form-wysiwig.html">Wysiwig Editors</a></li>
                            <li><a href="/backend/html/form-xeditable.html">X-editable</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-view-list"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="/backend/html/tables-basic.html">Basic Tables</a></li>
                            <li><a href="/backend/html/tables-datatable.html">Data Table</a></li>
                            <li><a href="/backend/html/tables-responsive.html">Responsive Table</a></li>
                            <li><a href="/backend/html/tables-editable.html">Editable Table</a></li>
                            <li><a href="/backend/html/tables-tablesaw.html">Tablesaw Table</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-chart"></i><span> Charts </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="/backend/html/chart-flot.html">Flot Chart</a></li>
                            <li><a href="/backend/html/chart-morris.html">Morris Chart</a></li>
                            <li><a href="/backend/html/chart-chartist.html">Chartist Charts</a></li>
                            <li><a href="/backend/html/chart-chartjs.html">Chartjs Chart</a></li>
                            <li><a href="/backend/html/chart-other.html">Other Chart</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="/backend/html/calendar.html" class="waves-effect"><i class="zmdi zmdi-calendar"></i><span> Calendar </span></a>
                    </li>

                    <li>
                        <a href="/backend/html/inbox.html" class="waves-effect"><i class="zmdi zmdi-email"></i><span class="label label-purple pull-right">New</span><span> Mail </span></a>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-collection-item"></i><span> Pages </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="/backend/html/page-starter.html">Starter Page</a></li>
                            <li><a href="/backend/html/page-login.html">Login</a></li>
                            <li><a href="/backend/html/page-register.html">Register</a></li>
                            <li><a href="/backend/html/page-recoverpw.html">Recover Password</a></li>
                            <li><a href="/backend/html/page-lock-screen.html">Lock Screen</a></li>
                            <li><a href="/backend/html/page-confirm-mail.html">Confirm Mail</a></li>
                            <li><a href="/backend/html/page-404.html">Error 404</a></li>
                            <li><a href="/backend/html/page-500.html">Error 500</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-layers"></i><span>Extra Pages </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="/backend/html/extras-projects.html">Projects</a></li>
                            <li><a href="/backend/html/extras-tour.html">Tour</a></li>
                            <li><a href="/backend/html/extras-taskboard.html">Taskboard</a></li>
                            <li><a href="/backend/html/extras-taskdetail.html">Task Detail</a></li>
                            <li><a href="/backend/html/extras-profile.html">Profile</a></li>
                            <li><a href="/backend/html/extras-maps.html">Maps</a></li>
                            <li><a href="/backend/html/extras-contact.html">Contact list</a></li>
                            <li><a href="/backend/html/extras-pricing.html">Pricing</a></li>
                            <li><a href="/backend/html/extras-timeline.html">Timeline</a></li>
                            <li><a href="/backend/html/extras-invoice.html">Invoice</a></li>
                            <li><a href="/backend/html/extras-faq.html">FAQ</a></li>
                            <li><a href="/backend/html/extras-gallery.html">Gallery</a></li>
                            <li><a href="/backend/html/extras-email-template.html">Email template</a></li>
                            <li><a href="/backend/html/extras-maintenance.html">Maintenance</a></li>
                            <li><a href="/backend/html/extras-comingsoon.html">Coming soon</a></li>
                        </ul>
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>

    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="card-box">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>

                            <h4 class="header-title m-t-0 m-b-30">Total Revenue</h4>

                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1">
                                    <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#f05050 "
                                           data-bgColor="#F9B9B9" value="58"
                                           data-skin="tron" data-angleOffset="180" data-readOnly=true
                                           data-thickness=".15"/>
                                </div>

                                <div class="widget-detail-1">
                                    <h2 class="p-t-10 m-b-0"> 256 </h2>
                                    <p class="text-muted">Revenue today</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-3 col-md-6">
                        <div class="card-box">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>

                            <h4 class="header-title m-t-0 m-b-30">Sales Analytics</h4>

                            <div class="widget-box-2">
                                <div class="widget-detail-2">
                                    <span class="badge badge-success pull-left m-t-20">32% <i class="zmdi zmdi-trending-up"></i> </span>
                                    <h2 class="m-b-0"> 8451 </h2>
                                    <p class="text-muted m-b-25">Revenue today</p>
                                </div>
                                <div class="progress progress-bar-success-alt progress-sm m-b-0">
                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                         aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                         style="width: 77%;">
                                        <span class="sr-only">77% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-3 col-md-6">
                        <div class="card-box">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>

                            <h4 class="header-title m-t-0 m-b-30">Statistics</h4>

                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1">
                                    <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#ffbd4a"
                                           data-bgColor="#FFE6BA" value="80"
                                           data-skin="tron" data-angleOffset="180" data-readOnly=true
                                           data-thickness=".15"/>
                                </div>
                                <div class="widget-detail-1">
                                    <h2 class="p-t-10 m-b-0"> 4569 </h2>
                                    <p class="text-muted">Revenue today</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-3 col-md-6">
                        <div class="card-box">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>

                            <h4 class="header-title m-t-0 m-b-30">Daily Sales</h4>

                            <div class="widget-box-2">
                                <div class="widget-detail-2">
                                    <span class="badge badge-pink pull-left m-t-20">32% <i class="zmdi zmdi-trending-up"></i> </span>
                                    <h2 class="m-b-0"> 158 </h2>
                                    <p class="text-muted m-b-25">Revenue today</p>
                                </div>
                                <div class="progress progress-bar-pink-alt progress-sm m-b-0">
                                    <div class="progress-bar progress-bar-pink" role="progressbar"
                                         aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                         style="width: 77%;">
                                        <span class="sr-only">77% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->

                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card-box">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>

                            <h4 class="header-title m-t-0">Daily Sales</h4>

                            <div class="widget-chart text-center">
                                <div id="morris-donut-example"style="height: 245px;"></div>
                                <ul class="list-inline chart-detail-list m-b-0">
                                    <li>
                                        <h5 style="color: #ff8acc;"><i class="fa fa-circle m-r-5"></i>Series A</h5>
                                    </li>
                                    <li>
                                        <h5 style="color: #5b69bc;"><i class="fa fa-circle m-r-5"></i>Series B</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-4">
                        <div class="card-box">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>
                            <h4 class="header-title m-t-0">Statistics</h4>
                            <div id="morris-bar-example" style="height: 280px;"></div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-4">
                        <div class="card-box">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>
                            <h4 class="header-title m-t-0">Total Revenue</h4>
                            <div id="morris-line-example" style="height: 280px;"></div>
                        </div>
                    </div><!-- end col -->

                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card-box widget-user">
                            <div>
                                <img src="{{ asset('backend/images/users/avatar-3.jpg') }}" class="img-responsive img-circle" alt="user">
                                <div class="wid-u-info">
                                    <h4 class="m-t-0 m-b-5 font-600">Chadengle</h4>
                                    <p class="text-muted m-b-5 font-13">coderthemes@gmail.com</p>
                                    <small class="text-warning"><b>Admin</b></small>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-3 col-md-6">
                        <div class="card-box widget-user">
                            <div>
                                <img src="{{ asset('backend/images/users/avatar-2.jpg') }}" class="img-responsive img-circle" alt="user">
                                <div class="wid-u-info">
                                    <h4 class="m-t-0 m-b-5 font-600"> Michael Zenaty</h4>
                                    <p class="text-muted m-b-5 font-13">coderthemes@gmail.com</p>
                                    <small class="text-custom"><b>Support Lead</b></small>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-3 col-md-6">
                        <div class="card-box widget-user">
                            <div>
                                <img src="{{ asset('backend/images/users/avatar-1.jpg') }}" class="img-responsive img-circle" alt="user">
                                <div class="wid-u-info">
                                    <h4 class="m-t-0 m-b-5 font-600">Stillnotdavid</h4>
                                    <p class="text-muted m-b-5 font-13">coderthemes@gmail.com</p>
                                    <small class="text-success"><b>Designer</b></small>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-3 col-md-6">
                        <div class="card-box widget-user">
                            <div>
                                <img src="{{ asset('backend/images/users/avatar-10.jpg') }}" class="img-responsive img-circle" alt="user">
                                <div class="wid-u-info">
                                    <h4 class="m-t-0 m-b-5 font-600">Tomaslau</h4>
                                    <p class="text-muted m-b-5 font-13">coderthemes@gmail.com</p>
                                    <small class="text-info"><b>Developer</b></small>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-lg-4">
                        <div class="card-box">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>

                            <h4 class="header-title m-t-0 m-b-30">Inbox</h4>

                            <div class="inbox-widget nicescroll" style="height: 315px;">
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="{{ asset('backend/images/users/avatar-1.jpg') }}" class="img-circle" alt=""></div>
                                        <p class="inbox-item-author">Chadengle</p>
                                        <p class="inbox-item-text">Hey! there I'm available...</p>
                                        <p class="inbox-item-date">13:40 PM</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="{{ asset('backend/images/users/avatar-2.jpg') }}" class="img-circle" alt=""></div>
                                        <p class="inbox-item-author">Tomaslau</p>
                                        <p class="inbox-item-text">I've finished it! See you so...</p>
                                        <p class="inbox-item-date">13:34 PM</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="{{ asset('backend/images/users/avatar-3.jpg') }}" class="img-circle" alt=""></div>
                                        <p class="inbox-item-author">Stillnotdavid</p>
                                        <p class="inbox-item-text">This theme is awesome!</p>
                                        <p class="inbox-item-date">13:17 PM</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="{{ asset('backend/images/users/avatar-4.jpg') }}" class="img-circle" alt=""></div>
                                        <p class="inbox-item-author">Kurafire</p>
                                        <p class="inbox-item-text">Nice to meet you</p>
                                        <p class="inbox-item-date">12:20 PM</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="{{ asset('backend/images/users/avatar-5.jpg') }}" class="img-circle" alt=""></div>
                                        <p class="inbox-item-author">Shahedk</p>
                                        <p class="inbox-item-text">Hey! there I'm available...</p>
                                        <p class="inbox-item-date">10:15 AM</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-8">
                        <div class="card-box">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>

                            <h4 class="header-title m-t-0 m-b-30">Latest Projects</h4>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Project Name</th>
                                        <th>Start Date</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Assign</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Adminto Admin v1</td>
                                        <td>01/01/2016</td>
                                        <td>26/04/2016</td>
                                        <td><span class="label label-danger">Released</span></td>
                                        <td>Coderthemes</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Adminto Frontend v1</td>
                                        <td>01/01/2016</td>
                                        <td>26/04/2016</td>
                                        <td><span class="label label-success">Released</span></td>
                                        <td>Adminto admin</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Adminto Admin v1.1</td>
                                        <td>01/05/2016</td>
                                        <td>10/05/2016</td>
                                        <td><span class="label label-pink">Pending</span></td>
                                        <td>Coderthemes</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Adminto Frontend v1.1</td>
                                        <td>01/01/2016</td>
                                        <td>31/05/2016</td>
                                        <td><span class="label label-purple">Work in Progress</span>
                                        </td>
                                        <td>Adminto admin</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Adminto Admin v1.3</td>
                                        <td>01/01/2016</td>
                                        <td>31/05/2016</td>
                                        <td><span class="label label-warning">Coming soon</span></td>
                                        <td>Coderthemes</td>
                                    </tr>

                                    <tr>
                                        <td>6</td>
                                        <td>Adminto Admin v1.3</td>
                                        <td>01/01/2016</td>
                                        <td>31/05/2016</td>
                                        <td><span class="label label-primary">Coming soon</span></td>
                                        <td>Adminto admin</td>
                                    </tr>

                                    <tr>
                                        <td>7</td>
                                        <td>Adminto Admin v1.3</td>
                                        <td>01/01/2016</td>
                                        <td>31/05/2016</td>
                                        <td><span class="label label-primary">Coming soon</span></td>
                                        <td>Adminto admin</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- end col -->

                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer text-right">
            2016 - 2017 © Adminto.
        </footer>

    </div>

    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

    <!-- Right Sidebar -->
    <div class="side-bar right-bar">
        <a href="javascript:void(0);" class="right-bar-toggle">
            <i class="zmdi zmdi-close-circle-o"></i>
        </a>
        <h4 class="">Notifications</h4>
        <div class="notification-list nicescroll">
            <ul class="list-group list-no-border user-list">
                <li class="list-group-item">
                    <a href="#" class="user-list-item">
                        <div class="avatar">
                            <img src="{{ asset('backend/images/users/avatar-2.jpg') }}" alt="">
                        </div>
                        <div class="user-desc">
                            <span class="name">Michael Zenaty</span>
                            <span class="desc">There are new settings available</span>
                            <span class="time">2 hours ago</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#" class="user-list-item">
                        <div class="icon bg-info">
                            <i class="zmdi zmdi-account"></i>
                        </div>
                        <div class="user-desc">
                            <span class="name">New Signup</span>
                            <span class="desc">There are new settings available</span>
                            <span class="time">5 hours ago</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#" class="user-list-item">
                        <div class="icon bg-pink">
                            <i class="zmdi zmdi-comment"></i>
                        </div>
                        <div class="user-desc">
                            <span class="name">New Message received</span>
                            <span class="desc">There are new settings available</span>
                            <span class="time">1 day ago</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item active">
                    <a href="#" class="user-list-item">
                        <div class="avatar">
                            <img src="{{ asset('backend/images/users/avatar-3.jpg') }}" alt="">
                        </div>
                        <div class="user-desc">
                            <span class="name">James Anderson</span>
                            <span class="desc">There are new settings available</span>
                            <span class="time">2 days ago</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item active">
                    <a href="#" class="user-list-item">
                        <div class="icon bg-warning">
                            <i class="zmdi zmdi-settings"></i>
                        </div>
                        <div class="user-desc">
                            <span class="name">Settings</span>
                            <span class="desc">There are new settings available</span>
                            <span class="time">1 day ago</span>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <!-- /Right-bar -->

</div>
<!-- END wrapper -->

<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/js/detect.js') }}"></script>
<script src="{{ asset('backend/js/fastclick.js') }}"></script>
<script src="{{ asset('backend/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('backend/js/waves.js') }}"></script>
<script src="{{ asset('backend/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('backend/js/jquery.scrollTo.min.js') }}"></script>

<!-- KNOB JS -->
<!--[if IE]>
<script type="text/javascript" src="{{ asset('backend/plugins/jquery-knob/excanvas.js') }}"></script>
<![endif]-->
<script src="{{ asset('backend/plugins/jquery-knob/jquery.knob.js') }}"></script>

<!--Morris Chart-->
<script src="{{ asset('backend/plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('backend/plugins/raphael/raphael-min.js') }}"></script>

<!-- Dashboard init -->
<script src="{{ asset('backend/pages/jquery.dashboard.js') }}"></script>

<!-- App js -->
<script src="{{ asset('backend/js/jquery.core.js') }}"></script>
<script src="{{ asset('backend/js/jquery.app.js') }}"></script>

</body>
</html>