@extends('layouts.master')

@section('title', 'Ecolife - Products')

@section('menu')
    @include('components.menu')
@endsection

@section('content')
    <div class="header__banner">
        <div class="header__banner-content">
            <div class="header__banner-sortlink">
                <a href={{route('home')}}>Trang chủ</a>
                <span>
                    <i class="fal fa-angle-right"></i>
                </span>
                <a href={{route('products')}}>Sản phẩm</a>
                <span>
                    <i class="fal fa-angle-right"></i>
                </span>
                <a href="{{route('products')}}/{{ $product->slug }}">{{ $product->name_product }}</a>
            </div>
        </div>
    </div>

    <div class="contai">
        <div class="row" style="padding-top: 6rem">
            <div class="col-md-5">
                <div class="viewProduct">
                    <img src="{{ Helper::exec()->getFirstImage($product->images) }}" alt="">
                </div>
                <div id="product-images" class="viewProduct__images owl-carousel">
                    @foreach($product->images as $image)
                        <div class="box_img">
                            <img class="img" src="{{ asset('images/products') }}/{{ $image->image }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-7">
                <div class="viewProduct__information">
                    <h1>{{ $product->name_product }}</h1>
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

                    <div class="viewProduct__desc">
                        {{ $product->decscription }}
                    </div>

                    <hr>

                    <form action="{{route('addCart')}}" method="post" id="form-add-cart">
                        @csrf
                        <div class="row choice-cart">
                            @if(count($product->sizes))
                                <div class="col-12 col-md-4">
                                    <label for="">Chọn size</label> 
                                    <select name="size" class="form-select">
                                        <option value=""></option>
                                        @foreach($product->sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            @if(count($product->colors))
                                <div class="col-12 col-md-4">
                                    <label for="">Chọn màu</label> 
                                    <select name="color" class="form-select">
                                        <option value=""></option>
                                        @foreach($product->colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex">
                            <div class="quantity__add">
                                <span type="button" id="decrementQuan">
                                    <i class="fal fa-minus"></i>
                                </span>
                                <input type="hidden" name="id_product" value="{{ $product->id }}">
                                <input type="text" name="quantity" id="quantity">
                                <span type="button" id="incrementQuan">
                                    <i class="fal fa-plus"></i>
                                </span>
                            </div>
                            <input type="submit" value="Thêm vào giỏ hàng" class="btn-addCart" id="btn-addCart">
                        </div>
                    </form>

                    @if($product->quantity_product == 0)
                        <p class="mt-4" style="font-size: 1.5rem; color: #f00;">Sản phẩm tạm thời hết hàng</p>
                    @endif

                    @if(session('notEnough'))
                        <p class="mt-4" style="font-size: 1.5rem; color: #f00;">{{session('notEnough')}}</p>
                    @endif

                </div>
            </div>

        </div>


        <div id="tabs" class="tabViewProduct">
            <ul>
                <li><a href="#decs">Mô tả</a></li>
                <li><a href="#comment">Bình luận</a></li>
            </ul>
            <div id="decs">
                <div class="viewProduct__desc viewProduct__desc-line">
                    {{ $product->decscription }}
                </div>
            </div>
            <div id="comment">
                @if(session('successComment'))
                    <div class="success_comment">
                        {{session('successComment')}}
                    </div>
                @endif

                @if(session('errorComment'))
                    <div class="error_comment">
                        {{session('errorComment')}}
                    </div>
                @endif

                <form action="{{route('addComment')}}" method="POST">
                    @csrf
                    <div class="form-group box-comment">
                        <input type="hidden" name="product_id" value={{ $product->id }}>
                        <textarea class="form-control" name="content" cols="30" rows="1" placeholder="Để lại phản hồi của bạn"></textarea>
                        <input type="submit" value="Bình luận" class="button-comment">
                    </div>
                </form>

                <div class="comment">
                    @foreach($comments as $comment)
                        <div class="comment__box">
                            <img src="{{ asset('images')}}/{{$comment->member->img_member}}" alt="">
                            <div class="comment__content">
                                <h3 class="comment__info">{{$comment->member->name_member }} 
                                    <span>({{ $comment->date_comment }})</span>
                                </h3>
                                <p>{{ $comment->content }}</p>
                            </div>
                            @if(\Helper::exec()->displayDeleteComment($comment->id_member))
                                <a href="{{ route('comment.destroy', $comment->id) }}" 
                                    onClick="return confirm('Bạn có muốn xóa bình luận!')" class="remove-comment">
                                    <i class="fal fa-backspace"></i>
                                </a>
                            @endif
                        </div>
                    @endforeach
                    @if(count($comments) == 0)
                        <p class="text-center" style="font-size: 1.4rem">Chưa có bình luận nào cho sản phẩm này</p>
                    @endif
                    
                </div>

            </div>
        </div>


        <div class="pos_title">
            <h2>Sản phẩm tương tự</h2>
        </div>

        <div id="product-cate" class="owl-carousel">
            @foreach($productCategory as $product)
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
 

    <script>
        $(function() {
            $("#tabs").tabs();
        });
    </script>

    <script src="{{asset('js/addWishList.js')}}"></script>

    <script>
        var getImageName = function() {
            $('.img').on('click', function(e) {
                var image = e.target.getAttribute("src");
                $('.viewProduct img').attr('src', image);
            })
        }

        getImageName();
    </script>

    @section('footer')
        @include('components.footer')
    @endsection

    <script src="{{asset('js/changeQuantityCart.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src={{asset('js/addCart.js')}}></script>
    <script src={{asset('js/setOwlCarousel.js')}}></script>

@endsection