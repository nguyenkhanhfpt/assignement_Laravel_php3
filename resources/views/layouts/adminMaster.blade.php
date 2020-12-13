<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <link rel="icon" href="{{ asset('images') }}/logo.png" />
    <title>{{ env('APP_NAME') }} - Admin</title>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    
    <link href="{{ asset('css') }}/morris.css" rel="stylesheet">
    
    <link href="{{ asset('css') }}/jquery.toast.css" rel="stylesheet">
    
    <link href="{{ asset('css') }}/style.min.css" rel="stylesheet">
    
    <link href="{{ asset('css') }}/dashboard1.css" rel="stylesheet">

    <script src="{{ asset('js/admin') }}/jquery-3.2.1.min.js"></script>

    <!-- sweetAlert -->
    <script src="{{ asset('js/admin') }}/sweetalert2@9.js"></script>

    <!-- This Page CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css') }}/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css') }}/responsive.dataTables.min.css">
    
    <link rel="stylesheet" href="{{asset('css/all.css')}}">

    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>
<body class="skin-default fixed-layout">
    <div id="app">
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">{{ env('APP_NAME') }}</p>
            </div>
        </div>

        <div id="main-wrapper">
            <header class="topbar">
                <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <!-- Logo icon --><b>
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                <img src="http://eliteadmin.themedesigner.in/demos/bt4/assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="http://eliteadmin.themedesigner.in/demos/bt4/assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                            </b>
                                <span>
                                    <img src="http://eliteadmin.themedesigner.in/demos/bt4/assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                                    <img src="http://eliteadmin.themedesigner.in/demos/bt4/assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
                                </span>
                            </a>
                    </div>
                    
                    <div class="navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)">
                                    <i class="fal fa-bars"></i>
                                </a> </li>
                            <li class="nav-item"> 
                                <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)">
                                    <i class="fal fa-bars"></i>
                                </a> 
                            </li>
                        </ul>
                        
                        <ul class="navbar-nav my-lg-0">
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fal fa-envelope"></i>
                                    <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown notification">
                                    <ul>
                                        <li>
                                            <div class="drop-title">Thông báo</div>
                                        </li>
                                        <li id="notification-content">
                                        </li>
                                        <li>
                                            <a class="nav-link text-center readed" href="javascript:void(0);"> 
                                                <strong>{{ trans('view.notification.mark_read') }}</strong> 
                                                <i class="fal fa-angle-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            
                            <li class="nav-item right-side-toggle"> 
                                <a class="nav-link  waves-effect waves-light" href="javascript:void(0)">
                                    <i class="fal fa-cog"></i>
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>
            </header>

            @include('components.sidebar')

            <div class="page-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            <div class="right-sidebar">
                <div class="slimscrollright">
                    <div class="rpanel-title"> Thay đổi màu
                        <span>
                            <i class="fal fa-times right-side-toggle"></i>
                        </span> 
                    </div>
                    <div class="r-panel-body">
                        <ul id="themecolors" class="m-t-20">
                            <li><b>With Light sidebar</b></li>
                            <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme working">1</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme">2</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme">3</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme">4</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme">5</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme">6</a></li>
                            <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                            <li><a href="javascript:void(0)" data-skin="skin-default-dark" class="default-dark-theme ">7</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme">8</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme">10</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-purple-dark" class="purple-dark-theme">11</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-megna-dark" class="megna-dark-theme ">12</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <footer class="footer">
                © 2020 Đồ án tốt nghiệp Cao đẳng FPT Polytechnic
            </footer>

        </div>
    </div>

    @yield('script')

    <script src="{{ asset('js/admin') }}/popper.min.js"></script>
    <script src="{{ asset('js/admin') }}/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('js/admin') }}/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="{{ asset('js/admin') }}/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('js/admin') }}/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('js/admin') }}/custom.min.js"></script>
    
    <!--morris JavaScript -->
    <script src="{{ asset('js/admin') }}/raphael-min.js"></script>
    <script src="{{ asset('js/admin') }}/morris.min.js"></script>
    <script src="{{ asset('js/admin') }}/jquery.sparkline.min.js"></script>
    <!-- Chart JS -->
    <script src="{{ asset('js/admin') }}/dashboard.js"></script>
    <script src="{{ asset('js/admin') }}/jquery.toast.js"></script>

    <script src="{{ asset('js') }}/notifications.js"></script>

</body>
</html>