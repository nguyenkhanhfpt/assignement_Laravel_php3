@extends('layouts.master')

@section('title', 'Ecolife - Giỏ hàng')

@section('menu')
    @include('components.menu')
@endsection

@section('content')
    <div class="contai">
        <div class="cart">
            <div class="cart__box payment__box">
                <div class="cart__item">
                    <div class="pos_title">
                        <h2>{{ trans('view.payment.confirm') }}</h2>
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

                    <form class="form-checkout">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="name_member">Name Member</label>
                            <input type="type" value="{{ $member->name_member }}" class="form-control" id="name_member" >
                            </div>
                            <div class="form-group col-md-6">
                            <label for="phone_number">Phone</label>
                            <input type="tell" class="form-control" value="{{ $member->phone_number }}" id="phone_number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" value="{{ $member->address }}" id="address">
                        </div>
                    </form>
                    
                    <a href="{{route('cart')}}" class="btn__buy btn__buy-margin mb-4">{{ trans('view.payment.back_cart') }}</a>
                </div>    
                <div class="cart__checkout">
                    <div class="card cart-summary">
                        <div class="cart-detailed-totals">

                            <div class="card-block">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="text-align: left">{{ trans('view.products') }}</th>
                                            <th>Size</th>
                                            <th>{{ trans('view.color') }}</th>
                                            <th>{{ trans('view.quantity') }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($carts as $key => $cart)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="{{ $cart['img_product'] }}" alt="">
                                                        <div class="cart__product-name">
                                                            <a href="{{route('products')}}/{{ $cart['slug'] }}" class="name_product">{{$cart['name_product']}}</a>
                                                            <p class="price-product">
                                                                {{number_format($cart['price_product'] * $cart['quantity'])}} đ
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($cart['size'])
                                                        <p>{{ $cart['size'] }}</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($cart['color'])
                                                        <p>{{ $cart['color'] }}</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$cart['quantity']}}
                                                </td>
                                                <td>
                                                    <a href="{{route('cart')}}/delete/{{$key}}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <hr class="separator">

                            <div class="card-block">
                                <div class="cart-summary-line" id="cart-subtotal-products">
                                    <span class="label js-subtotal">
                                        {{count($carts)}} {{ trans('view.cart.products') }}
                                    </span>
                                    <span class="value match_total">{{number_format($totalCart)}} đ</span>
                                </div>
                                <div class="cart-summary-line" id="cart-subtotal-shipping">
                                    <span class="label">
                                        {{ trans('view.cart.ship') }}
                                    </span>
                                    <span class="value">
                                        {{ trans('view.cart.free') }}
                                    </span>
                                </div>
                            </div>
                            
                            <hr class="separator">

                            <div class="card-block">
                                <div class="cart-summary-line cart-total">
                                    <span class="label">{{ trans('view.cart.total') }}</span>
                                    <span class="value match_total" id="match_total_sale" style="font-size: 1.7rem; color: #f00;">{{number_format($totalCartSale)}} đ</span>
                                </div>
                            </div>

                            <hr class="separator">

                            <div class="card-block">
                                <div class="code-sale">
                                    <input type="text" value="{{ session('code.name', '') }}" id="code" class="form-control" placeholder="{{ trans('view.code') }}">
                                    <button class="btn__apply">{{ trans('view.apply') }}</button>
                                </div>
                            </div>
                            <hr class="separator">
                        </div>

                        <div class="checkout text-sm-center card-block">
                            <a href="{{route('checkout')}}" class="btn__buy" id="btn__buy">{{ trans('view.cart.payment') }}</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('components.footer')

    <script src="{{ asset('js') }}/checkout.js"></script>

@endsection
