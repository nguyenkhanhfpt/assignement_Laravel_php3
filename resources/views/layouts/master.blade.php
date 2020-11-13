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
    <script src="{{asset('js/owl.carousel.js')}}"></script>

    <script src="{{asset('js/menu.js')}}"></script>

    <!-- sweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- Link Jquery Ui -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/productsPage.css')}}">
    <link rel="stylesheet" href="{{asset('css/account.css')}}">
    <link rel="stylesheet" href="{{asset('css/customCarousel.css')}}">
</head>
<body>
    @yield('menu')

    <div class="wrapper">
        @yield('content')

        @yield('footer')
    </div>
</body>
</html>