<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Thời trang nam, Thoi trang nam, ao quan, áo quần, sale, shop nam, shop gia re, thoi trang da nang, Thời trang Đà Nẵng" />
    <meta name="description" content="Hệ thống bán lẻ áo quần thời trang nam, đạt chuẩn xuất khẩu, uy tín giá rẻ nhất Đà Nẵng. Mua hàng online tại 
    {{ env('APP_NAME') }} với giá cả cạnh tranh, giao hàng COD toàn quốc, đổi trả miễn phí 30 ngày." />
    <meta property="og:title" content="{{ env('APP_NAME') }} - Áo quần, Phụ kiện thời trang chính hãng, uy tín" />
    <meta property="og:description" content="Hệ thống bán lẻ áo quần thời trang nam, đạt chuẩn xuất khẩu, uy tín giá rẻ nhất Đà Nẵng. Mua hàng online tại 
    {{ env('APP_NAME') }} với giá cả cạnh tranh, giao hàng COD toàn quốc, đổi trả miễn phí 30 ngày." />
    <meta property="og:site_name" content="{{ url('') }}"/>
    <meta property="og:url" content="{{ url('') }}"/>
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="vi_VN" />
    <meta itemprop="image" content="{{ asset('images') }}/about.jpg"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    @yield('meta')

    <title>@yield('title')</title>

    <link rel="icon" href="{{ asset('images') }}/logo.png" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <!-- owl.carousel -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <script src="{{ asset('js/owl.carousel.js') }}"></script>

    <script src="{{ asset('js/menu.js') }}"></script>

    <!-- sweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <!-- Link Jquery Ui -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/productsPage.css')}}">
    <link rel="stylesheet" href="{{asset('css/account.css')}}">
    <link rel="stylesheet" href="{{asset('css/customCarousel.css')}}">
    <link rel="stylesheet" href="{{asset('css/notifications.css')}}">

    <!-- link slick -->
    <link rel="stylesheet" href="{{ asset('css') }}/stick.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.0/slick/slick-theme.css">
    <script type="text/javascript" src="{{ asset('js') }}/slick.min.js"></script>
</head>
<body>
    <div id="app">
        @yield('menu')

        <div class="wrapper">
            @yield('content')

            @yield('footer')

            @yield('script')
        </div>

        <div class="modal fade" id="view-product" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer border-top-0">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Menu
                    <span>
                        <i class="fal fa-times right-side-toggle"></i>
                    </span> 
                </div>
                <div class="r-panel-body">
                    <ul>
                        <li class="nav__item">
                            <a class="nav__link {{ Request::route()->getName() == 'home' ? 'active' : '' }}" href={{route('home')}}>
                                {{ trans('view.home') }}
                            </a>
                        </li>
                        <li class="nav__item">
                            <a class="nav__link {{ Request::route()->getName() == 'products' ? 'active' : '' }}" href={{route('products')}}>
                                {{ trans('view.products') }}
                            </a>
                        </li>
                        <li class="nav__item">
                            <a class="nav__link {{ Request::route()->getName() == 'about' ? 'active' : '' }}" href="{{ route('about') }}">
                                {{ trans('view.introduce') }}
                            </a>
                        </li>
                        <li class="nav__item">
                            <a class="nav__link" id="link_contact-mobile" href="">
                                {{ trans('view.contact') }}
                            </a>
                        </li>
                        <li class="nav__item">
                            <a class="nav__link {{ Request::route()->getName() == 'cart' ? 'active' : '' }}" href={{route('cart')}}>
                                {{ trans('view.carts') }}
                            </a>
                        </li>
                        <li class="nav__item">
                            <a class="nav__link {{ Request::route()->getName() == 'news' ? 'active' : '' }}" href={{route('news')}}>
                                {{ trans('view.news.news') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/sendContact.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('js') }}/home.js"></script>
    <script src="{{ asset('js') }}/notifications.js"></script>

    @yield('script')
</body>
</html>