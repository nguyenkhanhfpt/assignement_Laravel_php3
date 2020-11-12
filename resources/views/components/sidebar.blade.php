<aside class="left-sidebar">
    <div class="scroll-sidebar">
        
        <div class="user-profile">
            <div class="user-pro-body">
                <div>
                    <img src="{{ asset('images') }}/user.jpg" alt="user-img" class="img-circle">
                </div>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false">Nguyen Khanh
                        <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu animated flipInY">
                        <a href="javascript:void(0)" class="dropdown-item">
                            <i class="ti-user"></i> My Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item">
                            <i class="ti-settings"></i> Account Setting
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="pages-login.html" class="dropdown-item">
                            <i class="fa fa-power-off"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- <li>
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="fal fa-tachometer-alt-fastest"></i>
                        <span class="hide-menu">Dashboard
                            <span class="badge badge-pill badge-cyan ml-auto">4</span>
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li>
                            <a href="index.html">Minimal</a>
                        </li>
                        <li>
                            <a href="index2.html">Analytical</a>
                        </li>
                        <li>
                            <a href="index3.html">Demographical</a>
                        </li>
                        <li>
                            <a href="index4.html">Modern</a>
                        </li>
                    </ul>
                </li> -->

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
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="far fa-list"></i>
                        <span class="hide-menu">Đơn hàng
                            <span class="badge badge-pill badge-primary text-white ml-auto">25</span>
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li>
                            <a href="ui-cards.html">Cards</a>
                        </li>
                        <li>
                            <a href="ui-user-card.html">User Cards</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        
    </div>

</aside>