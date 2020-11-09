<div class="cart__mini-product">
    @foreach(session('cart', []) as $key => $cart)
        <div class="product product-list">
            <div class="product-list-img">
                <img src="{{ $cart['img_product'] }}" alt="">
            </div>
            <div class="product__decs">
                <h2 class="product__name">
                    <a href="{{route('products')}}/{{$key}}" title="{{ $cart['name_product'] }}" class="one-line">{{ $cart['name_product']}}</a>
                </h2>
                <div class="product__price">
                    <span>{{$cart['quantity']}} x {{number_format($cart['price_product'])}} đ</span>
                </div>
            </div>
        </div>
    @endforeach
    @if(count(session('cart', [])) == 0) 
        <p>Không có sản phẩm nào trong giỏ hàng</p>
    @endif
</div>

<div class="cart__mini-checkout">
    <p>Thành tiền</p>
    <p>{{number_format(\Helper::exec()->mathTotalCart())}} đ</p>
</div>
<div class="cart__mini-checkout">
    <p>Vận chuyển</p>
    <p>Miễn phí</p>
</div>
<div class="cart__mini-checkout">
    <p>Tổng tiền</p>
    <p>{{number_format(\Helper::exec()->mathTotalCart())}} đ</p>
</div>

<div class="d-flex justify-content-center">
    <a href="{{route('cart')}}" class="btn__buy btn__buy-center">Thanh toán</a>
</div>