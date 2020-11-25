@extends('layouts.master')

@section('title', 'Ecolife - Yêu thích')

@section('menu')
    @include('components.menu')
@endsection

@section('content')
    <div class="header__banner">
        <div class="header__banner-content">
            <h2>{{ trans('view.your_wishlist') }}</h2>
            <div class="header__banner-sortlink">
                <a href={{route('home')}}>{{ trans('view.home') }}</a>
                <span>
                    <i class="fal fa-angle-right"></i>
                </span>
                <a href={{route('wishlist')}}>{{ trans('view.love') }}</a>
            </div>
        </div>
    </div>

    <div class="contai">
        <div class="wishList__box">
            <div class="pos_title">
                <h2>{{ trans('view.lists') }}</h2>
            </div>

            @foreach($wishlists as $wishlist)
                <div class="cart__product">
                    <div class="cart__product-img">
                        <img src="{{ \Helper::exec()->getFirstImage($wishlist->product->images) }}" alt="">
                    </div>
                    <div class="cart__product-name">
                        <a href="{{route('products')}}/{{ $wishlist->product->slug }}" 
                            class="name_product">{{ $wishlist->product->name_product }}</a>
                    </div>
                    <div class="cart__product-icon">
                        <p class="total-price">
                            {{ number_format(\Helper::exec()->match_price_sale($wishlist->product->price_product, $wishlist->product->sale)) }} đ
                        </p>
                        <a href="{{route('wishlist')}}/delete/{{ $wishlist->id }}">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
            @endforeach

            @if(count($wishlists) == 0) 
                <p class="" style="font-size: 1.6rem">{{ trans('view.nothing_wishlist') }}</p>
            @endif


        </div>

    </div> 

    @include('components.footer')

@endsection