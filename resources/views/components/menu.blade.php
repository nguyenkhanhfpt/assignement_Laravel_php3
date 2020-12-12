<nav class="wrapper">
    <div class="nav__top">
        <div class="d-flex">
            <p class="mb-0 d-none d-md-block">{{ trans('view.welcome', ['app' => env('APP_NAME')] ) }}</p>
            <div class="language-area ml-md-45">
                <ul>
                    <li>
                        @if (session('locale', config('app.locale')) == 'vi')
                            <img src="{{asset('images')}}/vietnam.png" />
                            <a href="{{ route('languale', 'vi') }}">Tiếng Việt</a>
                        @else
                            <img src="{{asset('images')}}/united-states-of-america.png" />
                            <a href="{{ route('languale', 'en') }}">Englist</a>
                        @endif
                        <i class="fal fa-angle-down ml-2"></i>
                        <div class="language-area-sub">
                            <ul>
                                <li>
                                @if (session('locale', config('app.locale')) == 'vi')
                                    <img src="{{asset('images')}}/united-states-of-america.png" />
                                    <a href="{{ route('languale', 'en') }}">Englist</a>
                                @else
                                    <img src="{{asset('images')}}/vietnam.png" />
                                    <a href="{{ route('languale', 'vi') }}">Tiếng Việt</a>
                                @endif
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            
        </div>
        
        <div class="nav__top-right">
            <div class="nav__top-item">
                <i class="fal fa-heart"></i>
                <a href="{{route('wishlist')}}">{{ trans('view.love') }}</a>
            </div>
            @guest
                <div class="nav__top-item">
                    <i class="fal fa-user"></i>
                    <a href="{{route('login')}}">{{ trans('view.sign_in') }}</a>
                </div>
                <div class="nav__top-item">
                    <i class="fal fa-lock-alt"></i>
                    <a href="{{route('register')}}">{{ trans('view.sign_up') }}</a>
                </div>
            @else
                <div class="nav__top-item">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" 
                        aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name_member }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" 
                    style="padding: .5rem .8rem;">
                        <a href="{{route('account')}}" class="dropdown-item">{{ trans('view.account_setting') }}</a>
                        @if(Auth::user()->role > 0)
                            <a href="{{route('admin')}}" class="dropdown-item">{{ trans('view.manage_web') }}</a>
                        @endif
                        <a class="dropdown-item dropdown-item-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ trans('view.logout') }}
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
        <h2 class="nav__logo"><a href={{route('home')}}>{{ env('APP_NAME') }}</a></h2>
        <div class="d-none d-md-block nav__list">
            <ul>
                <li class="nav__item">
                    <a class="nav__link {{ Request::route()->getName() == 'home' ? 'active' : '' }}" href={{route('home')}}>
                        {{ trans('view.home') }}
                    </a>
                </li>
                <li class="nav__item">
                    <a class="nav__link {{ Request::route()->getName() == 'products' ? 'active' : '' }}" href={{route('products')}}>
                        {{ trans('view.products') }}
                    <i class="fal fa-angle-down"></i>
                    </a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="">{{ trans('view.introduce') }}</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" id="link_contact" href="">
                        {{ trans('view.contact') }}
                    </a>
                </li>
                <li class="nav__item">
                    <a class="nav__link {{ Request::route()->getName() == 'cart' ? 'active' : '' }}" href={{route('cart')}}>
                        {{ trans('view.carts') }}
                    </a>
                </li>
                <li class="nav__item">
                    <a class="nav__link {{ Request::route()->getName() == 'news' ? 'active' : '' }}" href={{route('news')}}>
                        {{ trans('view.news.news') }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="nav__bottom-item">
            <div class=" nav__search">
                <div class="nav__box-search">
                    <form action="{{route('findProducts')}}" method="GET">
                        <input type="text" name="q">
                    </form>
                </div>
                <a href="javascript:void(0)">
                    <i class="far fa-search"></i>
                </a>
            </div>
            <div class="d-flex justify-content-end justify-content-md-start">
                <div class="py-2 mr-5">
                    <div class="nav__cart-icon">
                        <i class="fal fa-bell mb-2" id="notification" 
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                        <div class="number-cart" id="number-notify">
                            
                        </div>
                        <div class="dropdown-menu dropdown-menu-right notification animated bounceInDown" aria-labelledby="notification">
                            <ul>
                                <li>
                                    <div class="drop-title">
                                        <span>{{ trans('view.notification.notifications') }}</span>
                                    </div>
                                </li>
                                <li id="notification-content">
                                </li>
                                <li>
                                    <a class="nav-link text-center readed" href="javascript:void(0);"> 
                                        <strong>{{ trans('view.notification.mark_read') }}</strong> 
                                        <i class="fal fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="nav__cart">
                    <div class="nav__cart-icon">
                        <i class="fal fa-shopping-bag"></i>
                        <div class="number-cart" id="number-cart">
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
                                                <a href="{{route('products')}}/{{ $cart['slug'] }}" title="{{ $cart['name_product'] }}" class="one-line">{{ $cart['name_product']}}</a>
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

            <div class="d-block d-md-none menu-toggle">
                <i class="fal fa-bars ti-menu right-side-toggle"></i>
            </div>
               
        
        </div>
    </div>
</nav>