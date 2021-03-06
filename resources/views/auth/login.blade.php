@extends('layouts.master')

@section('title', 'Đăng nhập')

@section('menu')
    @include('components.menu')
@endsection

@section('content')
    <div class="contai">
        <div class="login">
            <div class="login__contain">
                <div class="login__img">
                    <img src="{{asset('images/header2.jpeg')}}" />
                </div>
                <div class="login__form">
                    <h3 class="login__title">Đăng nhập</h3>

                    <hr>

                    @if(session('error-status'))
                        <div class="alert alert-danger col-form-label mb-4">
                            {{ session('error-status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group form-group-grid">
                            <label for="email" class="col-form-label">Email đăng nhập</label>
                            
                            <div class="w-100">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" autofocus>

                                @error('email')
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
                                name="password" required >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-group-grid">
                            <label class="col-form-label"></label>

                            <div class="">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label pl-2" for="remember">
                                        Lưu mật khẩu
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-group-grid">
                            <label class="col-form-label"></label>

                            <div class="">
                                <button type="submit" class="btn__buy btn__buy-center">
                                    Đăng nhập
                                </button>

                                <span class="login__forget">Quên mật khẩu? Nhấn vào
                                    <a class="text-primary" href="{{ route('password.request') }}">
                                        đây
                                    </a>
                                </span>
                            </div>
                        </div>

                        <div class="form-group form-group-grid">
                            <label class="col-form-label"></label>
                            <a href="{{ route('auth_redirect', ['provider' => 'google']) }}" class="btn__buy text-center">
                                <i class="fab fa-google-plus-g"></i>
                                Đăng nhập bằng Google
                            </a>
                        </div>

                        

                        <div class="form-group form-group-grid">
                            <label class="col-form-label"></label>

                            <a href="{{route('register')}}" class="create-account mt-0">Đăng ký tài khoản mới</a>
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
