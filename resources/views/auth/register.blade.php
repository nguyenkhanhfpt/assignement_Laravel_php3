@extends('layouts.master')

@section('title', 'Đăng ký')

@section('menu')
    @include('components.menu')
@endsection

@section('content')
    <div class="contai">

        <div class="login register">
            <div class="login__contain">
                <div class="login__img">
                    <img src="{{asset('images/register_img.jpg')}}" />
                </div>
                <div class="login__form">
                    <h3 class="login__title">Đăng ký tài khoản</h3>

                    <hr>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group form-group-grid">
                            <label for="id_member" class="col-form-label">Tên đăng nhập</label>
                            
                            <div class="w-100">
                                <input id="id_member" type="text" class="form-control @error('id_member') is-invalid @enderror" 
                                name="id_member" value="{{ old('id_member') }}" autofocus>

                                @error('id_member')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-group-grid">
                            <label for="name_member" class="col-form-label">Tên người dùng</label>
                            <div class="w-100">
                                <input id="name_member" type="text" class="form-control @error('name_member') is-invalid @enderror" 
                                name="name_member" value="{{ old('name_member') }}">

                                @error('name_member')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group form-group-grid">
                            <label for="email" class="col-form-label">Email</label>
                            <div class="w-100">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-group-grid">
                            <label for="address" class="col-form-label">Địa chỉ</label>
                            <div class="w-100">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" 
                                name="address" value="{{ old('address') }}" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-group-grid">
                            <label for="phone_number" class="col-form-label">Số điện thoại</label>
                            <div class="w-100">
                                <input id="phone_number" type="tell" class="form-control @error('phone_number') is-invalid @enderror" 
                                name="phone_number" value="{{ old('phone_number') }}" autofocus>

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-group-grid">
                            <label for="" class="col-form-label">Giới tính</label>
                            <div class="w-100">
                                <div class="d-flex pt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="Nam" >
                                        <label class="form-check-label ml-2" for="male">
                                            Nam
                                        </label>
                                    </div>

                                    <div class="form-check ml-4">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="Nữ" >
                                        <label class="form-check-label ml-2" for="female">
                                            Nữ
                                        </label>
                                    </div>
                                </div>
                                
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>
                        </div>

                        <div class="form-group form-group-grid">
                            <label for="password" class="col-form-label">Mật khẩu</label>
                            
                            <div class="w-100">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                name="password" required placeholder="Mật khẩu từ 8 ký tự trở lên">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-group-grid">
                            <label for="password-confirm" class="col-form-label">Xác nhận mật khẩu</label>

                            <div class="w-100">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>

                        

                        <div class="form-group form-group-grid">
                            <label class="col-form-label"></label>

                            <div class="">
                                <button type="submit" class="btn__buy btn__buy-center">
                                    Đăng ký
                                </button>
                            </div>
                        </div>

                        <div class="form-group form-group-grid">
                            <label class="col-form-label"></label>

                            <a href="{{route('login')}}" class="create-account">Đăng nhập tài khoản</a>
                        </div>

                    </form>
                </div>
            </div> 
        </div>

    </div>



    @section('footer')
        @include('components.footer')
    @endsection

@endsection
