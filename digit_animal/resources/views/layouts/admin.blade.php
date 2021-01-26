<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="FlexAR">
        <meta name="author" content="Lance Bunch">

        <title>Digit.Localizator-Admin</title>
        <!-- <link href="{{ url('assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/plugins/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/plugins/datatables/fixedColumns.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css"> -->

        <!-- Plugins css-->
        <!-- <link href="{{ url('assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}" rel="stylesheet" />
        <link href="{{ url('assets/plugins/switchery/css/switchery.min.css')}}" rel="stylesheet" />
        <link href="{{ url('assets/plugins/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />
        <link href="{{ url('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" /> -->

        <link href="{{ url('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/css/core.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/css/components.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />
        <script src="{{ url('assets/js/modernizr.min.js')}}"></script>
        <link href="{{ url('assets/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />


        @yield('header')

    </head>

    <body class="fixed-left">
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="{{ url('/admin/dashboard') }}" class="logo"><i class="fa fa-star-half-o"></i><span>Digit.Animal<i class="fa fa-star-half-o"></i></span></a>
                        <!-- Image Logo here -->
                        <!--<a href="index.html" class="logo">-->
                        <!--<i class="icon-c-logo"> <img src="assets/images/logo_sm.png" height="42"/> </i>-->
                        <!--<span><img src="assets/images/logo_light.png" height="20"/></span>-->
                        <!--</a>-->
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>
                            <ul class="nav navbar-nav hidden-xs">
                                <li class="hidden-xs m-t-20">
                                    <i class="ti-alarm-clock text-white" id="curtime">2019-07-15 00:00:00</i>
                                </li>
                            </ul>

                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                                </li>

                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="{{ url('assets/images/avatar-1.jpg')}}" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/admin/personal_details') }}"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                                        <li><a href="{{ url('/admin/logout') }}"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div id="sidebar-menu">
                        <ul>
                            <li class="text-muted menu-title">Navigation</li>
                            <li class="">
                                <a href="{{ url('/admin/customers')}}" class="waves-effect">
                                    <i class="ti-user"></i><span>Customers</span>
                                </a>
                            </li>                            


                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-paint-bucket"></i> <span> Data Management </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li class="">
                                        <a href="{{ url('/admin/thingkinds')}}">
                                            <i class="typcn typcn-chart-pie-outline"></i>
                                            <span>Kinds of Things</span>
                                        </a>
                                    </li>

                                    <li class="">
                                        <a href="{{ url('/admin/devicemodels')}}">
                                            <i class="typcn typcn-chart-pie-outline"></i>
                                            <span>Device Models</span>
                                        </a>
                                    </li>

                                </ul>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="content-page">
                <div class="content">
                    @yield('content')
                </div>

                <footer class="footer text-right">
                    © 2019. All rights reserved.
                </footer>  
            </div> 
            <!-- content-page -->
        </div><!-- END wrapper -->

        <script src="{{ url('assets/js/jquery.min.js')}}"></script>
        <script src="{{ url('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{ url('assets/js/detect.js')}}"></script>
        <script src="{{ url('assets/js/fastclick.js')}}"></script>
        <script src="{{ url('assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{ url('assets/js/jquery.blockUI.js')}}"></script>
        <script src="{{ url('assets/js/waves.js')}}"></script>
        <script src="{{ url('assets/js/wow.min.js')}}"></script>
        <script src="{{ url('assets/js/jquery.nicescroll.js')}}"></script>
        <script src="{{ url('assets/js/jquery.scrollTo.min.js')}}"></script>

        <script src="{{ url('assets/plugins/multiselect/js/jquery.multi-select.js')}}"></script>
        <script src="{{ url('assets/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>
        <script src="{{ url('assets/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>

        @yield('footer')
        <script src="{{ url('assets/js/jquery.core.js')}}"></script>
        <script src="{{ url('assets/js/jquery.app.js')}}"></script>
        <script src="{{ url('assets/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>

        @yield('footer1')
        <script>    
            var cdDt = new Date(Date.parse("{{date('Y-m-d H:i:s')}}", "yyyy-MM-dd HH:mm:ss"));
            function timerFunction() {
                cdDt.setSeconds(cdDt.getSeconds() + 1);
                let formatted_date = cdDt.getFullYear() + "-" + (cdDt.getMonth() + 1) + "-" + cdDt.getDate() + " " + cdDt.getHours() + ":" + cdDt.getMinutes() + ":" + cdDt.getSeconds();
                document.getElementById("curtime").innerText = formatted_date;
            }
            setInterval(timerFunction, 1000);

            var resizefunc = [];
        </script>

    </body>
</html>
