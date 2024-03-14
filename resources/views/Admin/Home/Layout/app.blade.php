<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App favicon -->
    <link href="/assets/images/favicon.ico" rel="shortcut icon">
    <!-- App title -->
    <title>APPSCYCLONE</title>

    <!--Morris Chart CSS -->
    <link href="/plugins/morris/morris.css" rel="stylesheet">

    <!-- App css -->
    <link type="text/css" href="/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link type="text/css" href="/assets/css/core.css" rel="stylesheet" />
    <link type="text/css" href="/assets/css/components.css" rel="stylesheet" />
    <link type="text/css" href="/assets/css/icons.css" rel="stylesheet" />
    <link type="text/css" href="/assets/css/pages.css" rel="stylesheet" />
    <link type="text/css" href="/assets/css/menu.css" rel="stylesheet" />
    <link type="text/css" href="/assets/css/responsive.css" rel="stylesheet" />
    <link href="/plugins/switchery/switchery.min.css" rel="stylesheet">

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    @yield('header')
    <script src="/assets/js/modernizr.min.js"></script>
</head>

<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="spinner-wrapper">
                    <div class="rotator">
                        <div class="inner-spin"></div>
                        <div class="inner-spin"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a class="logo" href="index.html">
                    <img src="https://appscyclone.com/_nuxt/img/logo.d04fdce.svg" alt="">
                </a>
            </div>

            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">

                    <!-- Navbar-left -->
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <button class="button-menu-mobile open-left waves-effect waves-light">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>
                        <li class="hidden-xs">
                            <form class="app-search" role="search">
                                <input class="form-control" type="text" placeholder="Search...">
                                <a href=""><i class="fa fa-search"></i></a>
                            </form>
                        </li>
                        <li class="hidden-xs">
                            <a class="menu-item waves-effect waves-light" href="#">New</a>
                        </li>
                        <li class="dropdown hidden-xs">
                            <a class="dropdown-toggle menu-item waves-effect waves-light" data-toggle="dropdown"
                                href="#" aria-expanded="false">English
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">German</a></li>
                                <li><a href="#">French</a></li>
                                <li><a href="#">Italian</a></li>
                                <li><a href="#">Spanish</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Right(Notification) -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="right-menu-item dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="mdi mdi-bell"></i>
                                <span class="badge up bg-primary">4</span>
                            </a>

                            <ul
                                class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
                                <li>
                                    <h5>Notifications</h5>
                                </li>
                                <li>
                                    <a class="user-list-item" href="#">
                                        <div class="icon bg-info">
                                            <i class="mdi mdi-account"></i>
                                        </div>
                                        <div class="user-desc">
                                            <span class="name">New Signup</span>
                                            <span class="time">5 hours ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="user-list-item" href="#">
                                        <div class="icon bg-danger">
                                            <i class="mdi mdi-comment"></i>
                                        </div>
                                        <div class="user-desc">
                                            <span class="name">New Message received</span>
                                            <span class="time">1 day ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="user-list-item" href="#">
                                        <div class="icon bg-warning">
                                            <i class="mdi mdi-settings"></i>
                                        </div>
                                        <div class="user-desc">
                                            <span class="name">Settings</span>
                                            <span class="time">1 day ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="all-msgs text-center">
                                    <p class="m-0"><a href="#">See all Notification</a></p>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="right-menu-item dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="mdi mdi-email"></i>
                                <span class="badge up bg-danger">8</span>
                            </a>

                            <ul
                                class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
                                <li>
                                    <h5>Messages</h5>
                                </li>
                                <li>
                                    <a class="user-list-item" href="#">
                                        <div class="avatar">
                                            <img src="/assets/images/users/avatar-2.jpg" alt="">
                                        </div>
                                        <div class="user-desc">
                                            <span class="name">Patricia Beach</span>
                                            <span class="desc">There are new settings available</span>
                                            <span class="time">2 hours ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="user-list-item" href="#">
                                        <div class="avatar">
                                            <img src="/assets/images/users/avatar-3.jpg" alt="">
                                        </div>
                                        <div class="user-desc">
                                            <span class="name">Connie Lucas</span>
                                            <span class="desc">There are new settings available</span>
                                            <span class="time">2 hours ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="user-list-item" href="#">
                                        <div class="avatar">
                                            <img src="/assets/images/users/avatar-4.jpg" alt="">
                                        </div>
                                        <div class="user-desc">
                                            <span class="name">Margaret Becker</span>
                                            <span class="desc">There are new settings available</span>
                                            <span class="time">2 hours ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="all-msgs text-center">
                                    <p class="m-0"><a href="#">See all Messages</a></p>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="right-bar-toggle right-menu-item" href="javascript:void(0);">
                                <i class="mdi mdi-settings"></i>
                            </a>
                        </li>

                        <li class="dropdown user-box">
                            <a class="dropdown-toggle waves-effect waves-light user-link" data-toggle="dropdown"
                                href="" aria-expanded="true">
                                <img class="img-circle user-img" src="/assets/images/users/avatar-1.jpg"
                                    alt="user-img">
                            </a>

                            <ul
                                class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                                <li>
                                    <h5>Hi, {{ Auth::user()->name }}</h5>
                                </li>
                                <li><a href="javascript:void(0)"><i class="ti-user m-r-5"></i> Profile</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-settings m-r-5"></i> Settings</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-lock m-r-5"></i> Lock screen</a></li>
                                <li><a href="{{ route('logout') }}"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                            </ul>
                        </li>

                    </ul> <!-- end navbar-right -->

                </div><!-- end container -->
            </div><!-- end navbar -->
        </div>
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <div class="user-details">
                        <div class="overlay"></div>
                        <div class="text-center">
                            <img class="thumb-md img-circle" src="/assets/images/users/avatar-1.jpg" alt="">
                        </div>
                        <div class="user-info">
                            <div>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#setting-dropdown"
                                    aria-expanded="false">{{ Auth::user()->name }}<span
                                        class="mdi mdi-menu-down"></span></a>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown" id="setting-dropdown">
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"><i class="mdi mdi-face-profile m-r-5"></i> Profile</a>
                            </li>
                            <li><a href="javascript:void(0)"><i class="mdi mdi-account-settings-variant m-r-5"></i>
                                    Settings</a></li>
                            <li><a href="javascript:void(0)"><i class="mdi mdi-lock m-r-5"></i> Lock screen</a></li>
                            <li><a href="javascript:void(0)"><i class="mdi mdi-logout m-r-5"></i> Logout</a></li>
                        </ul>
                    </div>

                    <ul>
                        <li class="menu-title">Navigation</li>

                        @include('Admin.Home.Components.Sidebar.index')

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
                2016 - {{ now()->year }} © APPSCYCLONE.
            </footer>

        </div>

        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

        <!-- Right Sidebar -->
        <div class="side-bar right-bar">
            <a class="right-bar-toggle" href="javascript:void(0);">
                <i class="mdi mdi-close-circle-outline"></i>
            </a>
            <h4 class="">Settings</h4>
            <div class="setting-list nicescroll">
                <div class="row m-t-20">
                    <div class="col-xs-8">
                        <h5 class="m-0">Notifications</h5>
                        <p class="text-muted m-b-0"><small>Do you need them?</small></p>
                    </div>
                    <div class="col-xs-4 text-right">
                        <input data-plugin="switchery" data-color="#7fc1fc" data-size="small" type="checkbox"
                            checked />
                    </div>
                </div>

                <div class="row m-t-20">
                    <div class="col-xs-8">
                        <h5 class="m-0">API Access</h5>
                        <p class="m-b-0 text-muted"><small>Enable/Disable access</small></p>
                    </div>
                    <div class="col-xs-4 text-right">
                        <input data-plugin="switchery" data-color="#7fc1fc" data-size="small" type="checkbox"
                            checked />
                    </div>
                </div>

                <div class="row m-t-20">
                    <div class="col-xs-8">
                        <h5 class="m-0">Auto Updates</h5>
                        <p class="m-b-0 text-muted"><small>Keep up to date</small></p>
                    </div>
                    <div class="col-xs-4 text-right">
                        <input data-plugin="switchery" data-color="#7fc1fc" data-size="small" type="checkbox"
                            checked />
                    </div>
                </div>

                <div class="row m-t-20">
                    <div class="col-xs-8">
                        <h5 class="m-0">Online Status</h5>
                        <p class="m-b-0 text-muted"><small>Show your status to all</small></p>
                    </div>
                    <div class="col-xs-4 text-right">
                        <input data-plugin="switchery" data-color="#7fc1fc" data-size="small" type="checkbox"
                            checked />
                    </div>
                </div>
            </div>
        </div>
        <!-- /Right-bar -->

    </div>
    <!-- END wrapper -->

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/detect.js"></script>
    <script src="/assets/js/fastclick.js"></script>
    <script src="/assets/js/jquery.blockUI.js"></script>
    <script src="/assets/js/waves.js"></script>
    <script src="/assets/js/jquery.slimscroll.js"></script>
    <script src="/assets/js/jquery.scrollTo.min.js"></script>
    <script src="/plugins/switchery/switchery.min.js"></script>

    <!-- Counter js  -->
    <script src="/plugins/waypoints/jquery.waypoints.min.js"></script>
    <script src="/plugins/counterup/jquery.counterup.min.js"></script>

    <!--Morris Chart-->
    <script src="/plugins/morris/morris.min.js"></script>
    <script src="/plugins/raphael/raphael-min.js"></script>

    <!-- Dashboard init -->
    <script src="/assets/pages/jquery.dashboard.js"></script>

    <!-- App js -->
    <script src="/assets/js/jquery.core.js"></script>
    <script src="/assets/js/jquery.app.js"></script>
    @stack('scripts')

</body>

</html>
