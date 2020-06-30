@extends('layouts.master')

@section('title', 'Ecolife - Tài khoản')

@section('menu')
    @include('components.menu')
@endsection

@section('content')
    <div class="header__banner">
        <div class="header__banner-content">
            <h2>Tài khoản của bạn</h2>
            <div class="header__banner-sortlink">
                <a href={{route('home')}}>Trang chủ</a>
                <span>
                    <i class="fal fa-angle-right"></i>
                </span>
                <a href={{route('account')}}>Tài khoản</a>
            </div>
        </div>
    </div>

    <div class="contai">
        <div class="row mt-5" style="min-height: 400px">
            <div class="col-12 col-md-3">
                <div class="d-flex">
                    <img src="{{asset('images')}}/{{$user->img_member}}" class="rounded-circle" 
                    style="width: 6.5rem; height: 6.5rem">
                    <div class="info_account">
                        <p>Thông tin tài khoản</p>
                        <h6>{{$user->name_member}}</h6>
                    </div>
                </div>

                <!-- menu boostrap tab -->
                <div class="nav flex-column nav-pills mt-5 mb-4" id="account" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-profile" role="tab" 
                        aria-controls="v-pills-home" aria-selected="true">Thông tin tài khoản</a>

                    <a class="nav-link" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" 
                        aria-controls="v-pills-password" aria-selected="false">Thay đổi mật khẩu</a>

                    <a class="nav-link" id="v-pills-buy-tab" data-toggle="pill" href="#v-pills-buy" role="tab" 
                        aria-controls="v-pills-buy" aria-selected="false">Lịch sử mua hàng</a>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <!-- Nội dung của boostrap tab -->
                <div class="tab-content" id="account">

                    <!-- Phần thông tin tài khoản -->
                    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <h5 class="account__title">Thông tin tài khoản</h5>

                        @if(session('successUpdate'))
                            <p class="success">{{ session('successUpdate') }}</p>
                        @endif

                        <div class="border bg-white rounded p-3">
                            <form action="{{route('updateProfile')}}" method="POST" class="form_info" 
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="name_member" class="col-sm-2 col-form-label">Họ tên </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name_member') is-invalid @enderror" name="name_member" 
                                        id="name_member" value="{{$user->name_member}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone_number" class="col-sm-2 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" 
                                        name="phone_number" value="{{$user->phone_number}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" value="{{$user->email}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 col-form-label">Địa chỉ</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" 
                                        name="address" value="{{$user->address}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="img_member" class="col-sm-2 col-form-label">Thay đổi ảnh</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="img_member" class="form-control-file" id="img_member">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <input type="submit" class="btn__buy" value="Cập nhật">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Phần thay đổi mật khẩu -->
                    <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                        <h5 class="account__title">Thay đổi mật khẩu</h5>
                            @if(session('successUpdatePass'))
                                <p class="success">{{ session('successUpdatePass') }}</p>
                            @endif

                            @if(session('errUpdatePass'))
                                <p class="errorUpdate">{{ session('errUpdatePass') }}</p>
                            @endif

                            @error('password') 
                                <p class="errorUpdate">{{ $message }}</p>
                            @enderror

                        <div class="border bg-white rounded  p-3">
                            <form action="{{route('updatePassword')}}" class="form_info" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="oldPass" class="col-sm-2 col-form-label">Mật khẩu cũ</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="oldPass" name="oldPass" 
                                        placeholder="Mật khẩu của bạn">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="newPass" class="col-sm-2 col-form-label">Mật khẩu mới</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password" id="newPass" 
                                        placeholder="Mật khẩu phải trên 8 ký tự">
                                    </div>
                                </div>
                                <div class=" form-group row">
                                        <label for="newPassAgain" class="col-sm-2 col-form-label">Nhập lại mật khẩu</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="newPassAgain" name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <input type="submit" class="btn__buy" value="Cập nhật">
                                        </div>
                                    </div>
                            </form>

                        </div>
                    </div>

                    <!-- Phần lịch sử mua hàng -->
                    <div class="tab-pane fade" id="v-pills-buy" role="tabpanel" aria-labelledby="v-pills-buy-tab">
                        <h5 class="account__title">Lịch sử mua hàng</h5>
                        <div>
                            <table class="table table_member">
                                <thead>
                                    <tr>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Đơn giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Ngày mua</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bills as $item) 
                                        <tr>
                                            <td>
                                                <img src="{{asset('images')}}/{{$item->img_product}}" alt="">
                                                {{ $item->name_product }}
                                            </td>
                                            <td>
                                                {{ number_format($item->amount / $item->quantity_buy) }} đ
                                            </td>
                                            <td>
                                                {{ $item->quantity_buy }}
                                            </td>
                                            <td>
                                                {{ $item->date_buy }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')

@endsection