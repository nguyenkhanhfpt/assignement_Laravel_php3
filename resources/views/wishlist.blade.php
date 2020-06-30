@extends('layouts.master')

@section('title', 'Ecolife - Yêu thích')

@section('menu')
    @include('components.menu')
@endsection

@section('content')
    <div class="header__banner">
        <div class="header__banner-content">
            <h2>Danh sách yêu thích của bạn</h2>
            <div class="header__banner-sortlink">
                <a href={{route('home')}}>Trang chủ</a>
                <span>
                    <i class="fal fa-angle-right"></i>
                </span>
                <a href={{route('wishlist')}}>Yêu thích</a>
            </div>
        </div>
    </div>

    <div class="contai">
        <div class="wishList__box">
            <div class="pos_title">
                <h2>Danh sách</h2>
            </div>

            @foreach(session('wishList', []) as $key => $cart)
                <div class="cart__product">
                    <div class="cart__product-img">
                        <img src="{{asset('images')}}/{{$cart['img_product']}}" alt="">
                    </div>
                    <div class="cart__product-name">
                        <a href="{{route('products')}}/{{$key}}" class="name_product">{{$cart['name_product']}}</a>
                    </div>
                    <div class="cart__product-icon">
                        <p class="total-price">{{number_format($cart['price_product'])}} đ</p>
                        <a href="{{route('wishlist')}}/delete/{{$key}}">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
            @endforeach

            @if(count(session('wishList', [])) == 0) 
                <p class="" style="font-size: 1.6rem">Chưa có sản phẩm nào trong danh sách yêu thích</p>
            @endif


        </div>

    </div> 

    @include('components.footer')

@endsection