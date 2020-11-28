@extends('layouts.master')

@section('title', 'Ecolife - Giỏ hàng')

@section('menu')
    @include('components.menu')
@endsection

@section('content')
    <div class="contai">
        <div class="cart">
            <div class="cart__box">
                <div class="cart__item">
                    <div class="pos_title">
                        <h2>{{ trans('view.carts') }}</h2>
                    </div>

                    @if(session('buySuccess'))
                        <p class="buySuccess">
                            {{ session('buySuccess') }}
                        </p>
                    @endif

                    @if(session('errQuantity'))
                        <p class="errCart">
                            {{ session('errQuantity') }}
                        </p>
                    @endif

                    @if(session('errCart'))
                        <p class="errCart">
                            {{ session('errCart') }}
                        </p>
                    @endif

                    <form action="{{url('/cart/update')}}" id="formCart" method="POST">
                        @csrf
                        @foreach($sessionCart as $key => $cart)
                            <div class="cart__product">
                                <div class="cart__product-img">
                                    <img src="{{ $cart['img_product'] }}" alt="">
                                </div>
                                <div class="cart__product-name">
                                    <a href="{{route('products')}}/{{ $cart['slug'] }}" class="name_product">{{$cart['name_product']}}</a>
                                    <p class="price-product">{{number_format($cart['price_product'])}} đ</p>
                                </div>
                                <div class="cart__product-property">
                                    @if ($cart['size'])
                                        <p>{{ $cart['size'] }}</p>
                                    @endif
                                    @if ($cart['color'])
                                        <p>{{ $cart['color'] }}</p>
                                    @endif
                                </div>
                                <div class="cart__product-icon">
                                    <input class="input-quantity-cart quantity-{{$key}}" type="number" 
                                        data-id="{{ $cart['id'] }}" data-cart="{{ $key }}"
                                        value={{$cart['quantity']}}> 
                                    <p class="total-price">{{number_format($cart['price_product'] * $cart['quantity'])}} đ</p>
                                    <a href="{{route('cart')}}/delete/{{$key}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </form>
                    

                    @if(count($sessionCart) == 0)
                        <p class="alert_nothing">Không có sản phẩm nào trong giỏ hàng</p>
                    @endif
                    
                    <a href="{{route('products')}}" class="btn__buy btn__buy-margin mb-4">{{ trans('view.cart.continue_buy') }}</a>
                </div>    
                <div class="cart__checkout">
                    <div class="card cart-summary">
                        <div class="cart-detailed-totals">

                            <div class="card-block">
                                <div class="cart-summary-line" id="cart-subtotal-products">
                                    <span class="label js-subtotal">
                                        {{count($sessionCart)}} {{ trans('view.cart.products') }}
                                    </span>
                                    <span class="value match_total">{{number_format($totalCart)}} đ</span>
                                </div>
                                <div class="cart-summary-line" id="cart-subtotal-shipping">
                                    <span class="label">
                                        {{ trans('view.cart.ship') }}
                                    </span>
                                    <span class="value">{{ trans('view.cart.free') }}</span>
                                </div>
                            </div>
                            
                            <hr class="separator">

                            <div class="card-block">
                                <div class="cart-summary-line cart-total">
                                    <span class="label">{{ trans('view.cart.total') }}</span>
                                    <span class="value match_total" style="font-size: 1.7rem; color: #f00;">{{number_format($totalCart)}} đ</span>
                                </div>
                            </div>
                            
                            <hr class="separator">
                        </div>

                        <div class="checkout text-sm-center card-block">
                            <a href="{{route('checkout')}}" class="btn__buy">{{ trans('view.cart.payment') }}</a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>  

    @include('components.footer')

    <script src="{{ asset('js') }}/cart.js"></script>

@endsection