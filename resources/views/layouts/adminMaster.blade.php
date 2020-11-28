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
    
    <link rel="icon" type="image/png" sizes="16x16" href="http://eliteadmin.themedesigner.in/demos/bt4/assets/images/favicon.png">
    <title>Elite Admin Template - The Ultimate Multipurpose admin template</title>
    
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
                            
                            <li class="nav-item">
                                <form class="app-search d-none d-md-block d-lg-block">
                                    <input type="text" class="form-control" placeholder="Search & enter">
                                </form>
                            </li>
                        </ul>
                        
                        <ul class="navbar-nav my-lg-0">
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fal fa-envelope"></i>
                                    <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                    <ul>
                                        <li>
                                            <div class="drop-title">Notifications</div>
                                        </li>
                                        <li>
                                            <div class="message-center">
                                                <!-- Message -->
                                                <a href="javascript:void(0)">
                                                    <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                    <div class="mail-contnet">
                                                        <h5>Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span> </div>
                                                </a>
                                                <!-- Message -->
                                                <a href="javascript:void(0)">
                                                    <div class="btn btn-success btn-circle"><i class="ti-calendar"></i></div>
                                                    <div class="mail-contnet">
                                                        <h5>Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span> </div>
                                                </a>
                                                <!-- Message -->
                                                <a href="javascript:void(0)">
                                                    <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                                    <div class="mail-contnet">
                                                        <h5>Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>
                                                </a>
                                                <!-- Message -->
                                                <a href="javascript:void(0)">
                                                    <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                                    <div class="mail-contnet">
                                                        <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="nav-link text-center link" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            
                            <li class="nav-item dropdown mega-dropdown"> 
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fal fa-analytics"></i>
                                </a>
                                <div class="dropdown-menu animated bounceInDown">
                                    <ul class="mega-dropdown-menu row">
                                        <li class="col-lg-3 col-xlg-2 m-b-30">
                                            <h4 class="m-b-20">CAROUSEL</h4>
                                            <!-- CAROUSEL -->
                                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="carousel-item active">
                                                        <div class="container"> <img class="d-block img-fluid" src="http://eliteadmin.themedesigner.in/demos/bt4/assets/images/big/img1.jpg" alt="First slide"></div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="container"><img class="d-block img-fluid" src="http://eliteadmin.themedesigner.in/demos/bt4/assets/images/big/img2.jpg" alt="Second slide"></div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="container"><img class="d-block img-fluid" src="http://eliteadmin.themedesigner.in/demos/bt4/assets/images/big/img3.jpg" alt="Third slide"></div>
                                                    </div>
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
                                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                                            </div>
                                            <!-- End CAROUSEL -->
                                        </li>
                                        <li class="col-lg-3 m-b-30">
                                            <h4 class="m-b-20">ACCORDION</h4>
                                            <!-- Accordian -->
                                            <div class="accordion" id="accordionExample">
                                                <div class="card m-b-0">
                                                    <div class="card-header bg-white p-0" id="headingOne">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Collapsible Group Item #1
                                                        </button>
                                                    </h5>
                                                    </div>

                                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high. 
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card m-b-0">
                                                    <div class="card-header bg-white p-0" id="headingTwo">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Collapsible Group Item #2
                                                        </button>
                                                    </h5>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high.
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card m-b-0">
                                                    <div class="card-header bg-white p-0" id="headingThree">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        Collapsible Group Item #3
                                                        </button>
                                                    </h5>
                                                    </div>
                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high.
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-lg-3  m-b-30">
                                            <h4 class="m-b-20">CONTACT US</h4>
                                            <!-- Contact -->
                                            <form>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="exampleInputname1" placeholder="Enter Name"> </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" placeholder="Enter email"> </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Message"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-info">Submit</button>
                                            </form>
                                        </li>
                                        <li class="col-lg-3 col-xlg-4 m-b-30">
                                            <h4 class="m-b-20">List style</h4>
                                            <!-- List style -->
                                            <ul class="list-style-none">
                                                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> You can give link</a></li>
                                                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Give link</a></li>
                                                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another Give link</a></li>
                                                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Forth link</a></li>
                                                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another fifth link</a></li>
                                            </ul>
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
                © 2020 Đồ án tốt nghiệp FPT Polytechnic
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
</body>
</html>