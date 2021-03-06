@extends('layouts.master')

@section('title', env('APP_NAME') .' - Áo quần, Phụ kiện thời trang chính hãng, uy tín')

@section('menu')
    @include('components.menu')
@endsection


@section('content')
    <header class="slider" id="header">
        <img src="{{asset('images/about.jpg')}}" alt="">
        <img src="{{asset('images/header2.jpeg')}}" alt="">
        <img src="{{asset('images/header.jpeg')}}" alt="">
    </header>
    
    <div class="contai">
        <section class="feature">
            <div class="feature__box">
                <div class="row">
                    <dic class="col-12 col-md-3 mb-4 mb-md-0 feature__item">
                        <i class="fal fa-shipping-fast"></i>
                        <div class="feature__item-content">
                            <h2>@lang('view.banner.free_ship')</h2>
                            <p>@lang('view.banner.free_ship_desc')</p>
                        </div>
                    </dic>
                    <dic class="col-12 col-md-3 mb-4 mb-md-0 feature__item">
                        <i class="fal fa-exchange-alt"></i>
                        <div class="feature__item-content">
                            <h2>@lang('view.banner.return')</h2>
                            <p>@lang('view.banner.return_desc')</p>
                        </div>
                    </dic>
                    <dic class="col-12 col-md-3 mb-4 mb-md-0 feature__item">
                        <i class="fal fa-credit-card"></i>
                        <div class="feature__item-content">
                            <h2>@lang('view.banner.payment')</h2>
                            <p>@lang('view.banner.payment_desc')</p>
                        </div>
                    </dic>
                    <dic class="col-12 col-md-3 mb-md-0 feature__item">
                        <i class="fad fa-user-headset"></i>
                        <div class="feature__item-content">
                            <h2>@lang('view.banner.support')</h2>
                            <p>@lang('view.banner.payment_desc')</p>
                        </div>
                    </dic>
                </div>
            </div>
        </section>   

        <!-- Products -->
        <div class="best_seller">
            <div class="pos_title">
                <h2>@lang('view.selling_pro')</h2>
                <p class="decs_title">@lang('view.all_selling_pro')</p>
            </div>

            <div id="products" class="owl-carousel">
                @foreach($datas as $product)
                    <div class="product">
                        <div class="product__img">
                            <a href="{{route('products')}}/{{$product->slug}}">
                                <img src="{{ Helper::exec()->getFirstImage($product->images) }}" alt="">
                            </a>
                        </div>
                        <div class="product__decs">
                            <div class="manufacturer">
                                <a href="{{route('products')}}?category={{$product->category->id}}">{{ $product->category->name }}</a>
                            </div>
                            <h2 class="product__name">
                                <p class="id__product d-none">{{$product->id}}</p>
                                <a href="{{route('products')}}/{{$product->slug}}" class="one-line" title="{{ $product->name_product }}">
                                {{ $product->name_product }}
                                </a>
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
                @endforeach
                
            <!-- end owl -->
            </div>
        </div>

        <div class="hot-product">
            <div class="col px-0">
                <div class="pos_title">
                    <h2>@lang('view.good_discount')</h2>
                    <p class="decs_title">@lang('view.sale_store')</p>
                </div>

                <div id="product-sale" class="owl-carousel">
                    @foreach($nominationPro as $product)
                        <div class="product">
                            <div class="product__img">
                                <a href="{{route('products')}}/{{$product->slug}}">
                                    <img src="{{ Helper::exec()->getFirstImage($product->images) }}" alt="">
                                </a>

                            </div>
                            <div class="product__decs">
                                <div class="manufacturer">
                                <p class="id__product d-none">{{$product->id}}</p>
                                    <a href="{{route('products')}}?category={{$product->category->id}}">{{ $product->category->name }}</a>
                                </div>
                                <h2 class="product__name">
                                    <a href="{{route('products')}}/{{$product->slug}}" class="one-line" 
                                    title="{{ $product->name_product }}" >{{ $product->name_product }}</a>
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
                    @endforeach
                <!-- end owl -->
                </div>
            </div>

            <div class="col px-0">
                <div class="pos_title">
                    <h2>@lang('view.new_pro')</h2>
                    <p class="decs_title">@lang('view.all_new_pro')</p>
                </div>

                <div id="new-product" class="owl-carousel">
                    @for($num = 0; $num <= config('settings.limit'); $num += 2)
                        <div class="item">
                            <div class="product">
                                <div class="product__img">
                                    <a href="{{route('products')}}/{{$newProducts[$num]->slug}}">
                                        <img src="{{ Helper::exec()->getFirstImage($newProducts[$num]->images) }}" alt="">
                                    </a>

                                </div>
                                <div class="product__decs">
                                    <div class="manufacturer">
                                        <a href="{{route('products')}}?category={{$newProducts[$num]->category->id}}">
                                            {{ $newProducts[$num]->category->name }}
                                        </a>
                                    </div>
                                    <h2 class="product__name">
                                        <p class="id__product d-none">{{$newProducts[$num]->id}}</p>
                                        <a href="{{route('products')}}/{{$newProducts[$num]->slug}}" class="one-line" 
                                        title="{{ $newProducts[$num]->name_product }}" >{{ $newProducts[$num]->name_product }}</a>
                                    </h2>
                                    <div class="product__price">
                                        @if($newProducts[$num]->sale > 0)
                                            <div class="product__price-sale">
                                                <span><del>{{number_format($newProducts[$num]->price_product)}} đ</del></span>
                                                <span class="new-price">
                                                    {{number_format(\Helper::exec()->match_price_sale($newProducts[$num]->price_product, $newProducts[$num]->sale))}} đ
                                                </span>
                                            </div>
                                        @else
                                            <span>{{number_format($newProducts[$num]->price_product)}} đ</span>
                                        @endif
                                    </div>


                                    <div class="product__add-cart">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="" class="add-cart">{{ trans('view.add_to_cart') }}</a>
                                            <a href="" class="add_wishlist" data-name="{{$newProducts[$num]->name_product}}" 
                                            data-id="{{ $newProducts[$num]->id }}">
                                                <i class="far fa-heart"></i>
                                            </a>
                                        </div>
                                        
                                    </div>

                                </div>

                                @if(\Helper::exec()->time_between_two_days($newProducts[$num]->date)) 
                                    <div class="new">
                                        New
                                    </div>
                                @endif

                                @if($newProducts[$num]->sale > 0)
                                    <div class="sale">
                                        {{ $newProducts[$num]->sale }}%
                                    </div>
                                @endif

                            </div>
                            <div class="product">
                                <div class="product__img">
                                    <a href="{{route('products')}}/{{$newProducts[$num + 1]->slug}}">
                                        <img src="{{ Helper::exec()->getFirstImage($newProducts[$num + 1]->images) }}" alt="">
                                    </a>

                                </div>
                                <div class="product__decs">
                                    <div class="manufacturer">
                                        <a href="{{route('products')}}?category={{$newProducts[$num + 1]->category->id}}">
                                            {{ $newProducts[$num + 1]->category->name }}
                                        </a>
                                    </div>
                                    <h2 class="product__name">
                                        <p class="id__product d-none">{{$newProducts[$num + 1]->id}}</p>
                                        <a href="{{route('products')}}/{{$newProducts[$num + 1]->slug}}" class="one-line" 
                                        title="{{ $newProducts[$num + 1]->name_product }}" >{{ $newProducts[$num + 1]->name_product }}</a>
                                    </h2>
                                    <div class="product__price">
                                        @if($newProducts[$num + 1]->sale > 0)
                                            <div class="product__price-sale">
                                                <span><del>{{number_format($newProducts[$num + 1]->price_product)}} đ</del></span>
                                                <span class="new-price">
                                                    {{number_format(\Helper::exec()->match_price_sale($newProducts[$num + 1]->price_product, $newProducts[$num + 1]->sale))}} đ
                                                </span>
                                            </div>
                                        @else
                                            <span>{{number_format($newProducts[$num + 1]->price_product)}} đ</span>
                                        @endif
                                    </div>


                                    <div class="product__add-cart">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="" class="add-cart">{{ trans('view.add_to_cart') }}</a>
                                            <a href="" class="add_wishlist" data-name="{{$newProducts[$num + 1]->name_product}}" 
                                            data-id="{{$newProducts[$num + 1]->id}}">
                                                <i class="far fa-heart"></i>
                                            </a>
                                        </div>
                                        
                                    </div>

                                </div>

                                @if(\Helper::exec()->time_between_two_days($newProducts[$num + 1]->date)) 
                                    <div class="new">
                                        New
                                    </div>
                                @endif

                                @if($newProducts[$num + 1]->sale > 0)
                                    <div class="sale">
                                        {{ $newProducts[$num + 1]->sale }}%
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endfor
                </div>
                
            </div>
        </div>


        <div class="banner">
            <div class="banner__box">
                <img src="{{asset('images/home_banner.jpeg')}}" alt="">
            </div>
        </div>


        <div class="products__view">
            <div class="pos_title">
                <h2>@lang('view.pro_viewed')</h2>
                <p class="decs_title">@lang('view.pro_interested')</p>
            </div>

            <div id="products-view" class="owl-carousel">
                @foreach($productView as $product)
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
                @endforeach
                
            <!-- end owl -->
            </div>
        </div>
    </div>
    <!-- End contai -->
    
    @section('footer')
        @include('components.footer')
    @endsection


    <script src={{asset('js/addWishList.js')}}></script>
    <script src={{asset('js/addCart.js')}}></script>
    <script src={{asset('js/setOwlCarousel.js')}}></script>

    <script>
        $('#header').slick({
            dots: false,
            autoplay: true,
            autoplaySpeed: 5000,
            slidesToShow: 1,
            slidesToScroll: 1,
        });
    </script>

@endsection
