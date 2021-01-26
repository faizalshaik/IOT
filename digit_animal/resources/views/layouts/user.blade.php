<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FlexAR">
    <meta name="author" content="Lance Bunch">

    <title>Digit.Localizator</title>
    <link href="{{ url('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/core.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/components.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ url('assets/js/modernizr.min.js')}}"></script>

    <link href="{{ url('assets/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />    

    <style>
        #map {
            height: 100%;
        }

        #wrapper
        {
            height: 100%;
        }        

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>

    @yield('header')

</head>

<body>

    <div id="wrapper">
        @yield('content')
    </div>
    <!-- <div class="content">            
        </div> -->

    <!-- <div class="content-page">
        </div>      -->

    <!-- Begin page -->
    <!-- <div id="wrapper">
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
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i> <span> Data Management </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li class="">
                                        <a href="{{ url('Cms/bets_list')}}">
                                            <i class="ti-server"></i>
                                            <span>Bets List</span>
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
        </div> -->

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


    @yield('footer_left')
    @yield('footer_for_areas')
    @yield('footer_for_devices')
    @yield('footer_for_personal')
    
    @yield('footer_right')
    @yield('footer_main')
    <script>
        var resizefunc = [];
    </script>

</body>

</html>