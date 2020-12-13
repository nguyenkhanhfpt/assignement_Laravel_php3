<aside class="left-sidebar">
    <div class="scroll-sidebar">
        
        <div class="user-profile">
            <div class="user-pro-body">
                <div>
                    <img src="{{ asset('images') }}/{{ Auth::user()->img_member }}" height="50" alt="user-img" class="img-circle">
                </div>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false">{{ Auth::user()->name_member }}
                        <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu animated flipInY">
                        <a href="{{ route('account') }}" class="dropdown-item">
                            <i class="ti-user"></i> Tài khoản của tôi
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" 
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" 
                            class="dropdown-item">
                            <i class="fa fa-power-off"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('admin') }}" aria-expanded="false">
                        <i class="fal fa-tachometer-alt-fastest"></i>
                        <span class="hide-menu">Quản lý</span>
                    </a>
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="{{ route('adminCategory') }}" aria-expanded="false">
                        <i class="far fa-list"></i>
                        <span class="hide-menu">Danh mục</span>
                    </a>
                </li>

                <li>
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="fal fa-tshirt"></i>
                        <span class="hide-menu">Sản phẩm
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li>
                            <a href="{{ route('colors.index') }}">Màu</a>
                        </li>
                        <li>
                            <a href="{{ route('sizes.index') }}">Size</a>
                        </li>
                        <li>
                            <a href="{{ route('adminProduct') }}">Danh sách</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="{{ route('codes.index') }}" aria-expanded="false">
                        <i class="far fa-barcode"></i>
                        <span class="hide-menu">Mã giảm giá</span>
                    </a>
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="{{ route('adminMember') }}" aria-expanded="false">
                        <i class="fal fa-users"></i>
                        <span class="hide-menu">Người dùng</span>
                    </a>
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="{{ route('adminComment') }}" aria-expanded="false">
                        <i class="fal fa-comments-alt"></i>
                        <span class="hide-menu">Bình luận</span>
                    </a>
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="{{ route('news.index') }}" aria-expanded="false">
                        <i class="fal fa-newspaper"></i>
                        <span class="hide-menu">Bài viết</span>
                    </a>
                </li>

                <li>
                    <a class="waves-effect waves-dark" href="{{ route('adminBill') }}" aria-expanded="false">
                        <i class="fal fa-cart-plus"></i>
                        <span class="hide-menu">Đơn hàng
                            <span class="badge badge-pill badge-primary text-white ml-auto" id="numPeddingBill">
                                {{ Helper::exec()->getNumPeddingBill() }}
                            </span>
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
        
    </div>

</aside>