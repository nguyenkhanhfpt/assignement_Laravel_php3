@extends('layouts.master')

@section('title', 'Ecolife - Products')

@section('menu')
    @include('components.menu')
@endsection

@section('content')
    <div class="header__banner">
        <div class="header__banner-content">
            <h2>Sản phẩm</h2>
            <div class="header__banner-sortlink">
                <a href={{route('home')}}>Trang chủ</a>
                <span>
                    <i class="fal fa-angle-right"></i>
                </span>
                <a href={{route('products')}}>Sản phẩm</a>
            </div>
        </div>
    </div>

    <div class="contai">
        <div class="row" style="padding-top: 6rem">

            <div class="col-md-3">
                <div class="product__title-main">
                    <p>Danh mục sản phẩm</p>
                </div>
                <div class="products__categories">
                    @foreach($categories as $category)
                        <div class="products__categories-item">
                            <a href="{{route('products')}}?category={{$category->id}}">
                                {{ $category->name }} <span>({{ count($category->products) }})</span></a>
                        </div>
                    @endforeach
                </div>

                <div class="topview">
                    <div class="product__title-main">
                        <p>Top sản phẩm</p>
                    </div>

                    @foreach($productView as $product)
                        <div class="product product-list">
                            <div class="product-list-img">
                                <img src="{{ Helper::exec()->getFirstImage($product->images) }}" alt="">
                            </div>
                            <div class="product__decs">
                                <div class="manufacturer">
                                    <a href="{{route('products')}}?category={{$product->id}}">
                                        {{ $product->category->name}}
                                    </a>
                                </div>
                                <h2 class="product__name">
                                    <a href="{{route('products')}}/{{$product->slug}}" title="{{ $product->name_product }}" class="one-line">{{ $product->name_product}}</a>
                                </h2>
                                <div class="product__price">
                                    @if($product->sale > 0)
                                        <div class="product__price-sale">
                                            <span><del>{{number_format($product->price_product)}} đ</del></span>
                                            <span class="new-price">
                                                {{number_format($product->price_product - ($product->price_product / 100 * $product->sale))}} đ
                                            </span>
                                        </div>
                                    @else
                                        <span>{{number_format($product->price_product)}} đ</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <div class="col-md-9">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-3">
                            <div class="product">
                                <div class="product__img">
                                    <a href="{{route('products')}}/{{$product->slug}}">
                                        <img src="{{ Helper::exec()->getFirstImage($product->images) }}" alt="">
                                    </a>
                                </div>
                                <div class="product__decs">
                                    <div class="manufacturer">
                                        <a href="{{route('products')}}?category={{$product->category->id}}">{{$product->category->name}}</a>
                                    </div>
                                    <h2 class="product__name">
                                        <p class="id__product d-none">{{$product->id}}</p>
                                        <a href="{{route('products')}}/{{$product->slug}}" class="one-line" 
                                        title="{{$product->name_product}}">{{$product->name_product}}</a>
                                    </h2>
                                    <div class="product__price">
                                        @if($product->sale > 0)
                                            <div class="product__price-sale">
                                                <span><del>{{number_format($product->price_product)}} đ</del></span>
                                                <span class="new-price">
                                                    {{number_format(\Helper::exec()->match_price_sale($product->price_product, $product->sale))}} đ
                                                </span>
                                            </div>
                                        @else
                                            <span>{{number_format($product->price_product)}} đ</span>
                                        @endif
                                    </div>


                                    <div class="product__add-cart">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="" class="add-cart">{{ trans('view.add_to_cart') }}</a>
                                            <a href="" class="add_wishlist" data-name="{{$product->name_product}}" data-id="{{$product->id}}">
                                                <i class="far fa-heart"></i>
                                            </a>
                                        </div>
                                        
                                    </div>
                                </div>

                                @if(\Helper::exec()->time_between_two_days($product->date)) 
                                    <div class="new">
                                        New
                                    </div>
                                @endif

                                @if($product->sale > 0)
                                    <div class="sale">
                                        {{ $product->sale }}%
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center paginate">
                    {{ $products->withQueryString()->links() }}
                </div>
                
            </div>

        </div>
    </div>


    @include('components.footer')

    <script src={{asset('js/addWishList.js')}}></script>
    <script src={{asset('js/addCart.js')}}></script>

@endsection