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

                @yield('content')

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