<nav class="wrapper">
    <div class="nav__top">
        <p class="mb-0 d-none d-md-block">Chào mừng bạn đến với Ecolife!</p>
        <div class="nav__top-right">
            <div class="nav__top-item">
                <i class="fal fa-heart"></i>
                <a href="{{route('wishlist')}}">Yêu thích</a>
            </div>
            @guest
                <div class="nav__top-item">
                    <i class="fal fa-user"></i>
                    <a href="{{route('login')}}">Đăng nhập</a>
                </div>
                <div class="nav__top-item">
                    <i class="fal fa-lock-alt"></i>
                    <a href="{{route('register')}}">Đăng ký</a>
                </div>
            @else
                <div class="nav__top-item">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name_member }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" 
                    style="padding: .5rem .8rem;">
                        <a href="{{route('account')}}" class="dropdown-item">Tài khoản</a>
                        @if(Auth::user()->role > 0)
                            <a href="{{route('admin')}}" class="dropdown-item">Quản trị trang web</a>
                        @endif
                        <a class="dropdown-item dropdown-item-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Đăng xuất
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="nav__bottom">
        <h2 class="nav__logo"><a href={{route('home')}}>Ecolife</a></h2>
        <div class="nav__list">
            <ul>
                <li class="nav__item">
                    <a class="nav__link" href={{route('home')}}>Trang chủ</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href={{route('products')}}>Sản phẩm
                    <i class="fal fa-angle-down"></i>
                    </a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="">Giới thiệu</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="">Liên hệ</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href={{route('cart')}}>Giỏ hàng</a>
                </li>
            </ul>
        </div>
        <div class="nav__bottom-item">
            <div class="nav__search">
                <div class="nav__box-search">
                    <form action="{{route('findProducts')}}" method="GET">
                        <input type="text" name="q">
                    </form>
                </div>
                <a href="javascript:void(0)">
                    <i class="far fa-search"></i>
                </a>
            </div>
            <div class="nav__cart">
                <div class="nav__cart-icon">
                    <i class="fal fa-shopping-bag"></i>
                    <div class="number-cart">
                        @if(session('cart'))
                            {{ count(session('cart')) }}
                        @else
                            0
                        @endif
                    </div>
                </div>

                <div class="cart__amount">
                    <span class="pl-2">{{ number_format(\Helper::exec()->mathTotalCart()) }}</span> đ
                </div>

                <div class="nav__cart-mini">
                        <div class="cart__mini-content">
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
                            
                        </div>
                    </div>
            </div>

        </div>
    </div>
</nav>