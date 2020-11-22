<div class="row">
    <div class="col-md-4">
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

    <div class="col-md-8">
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

<script>
    var getImageName = function() {
        $('.img').on('click', function(e) {
            var image = e.target.getAttribute("src");
            $('.viewProduct img').attr('src', image);
        })
    }

    getImageName();
</script>

<script src={{asset('js/changeQuantityCart.js')}}></script>
<script src={{asset('js/addCart.js')}}></script>
<script src={{asset('js/setOwlCarousel.js')}}></script>