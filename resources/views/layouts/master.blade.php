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
    <meta itemprop="image" content="{{ asset('images') }}/ecolife-side.jpeg"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">

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
                    
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/sendContact.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('js') }}/home.js"></script>
    <script src="{{ asset('js') }}/notifications.js"></script>

    @yield('script')

    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v9.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="101828574736063"
        theme_color="#4fb68d">
      </div>
</body>
</html>