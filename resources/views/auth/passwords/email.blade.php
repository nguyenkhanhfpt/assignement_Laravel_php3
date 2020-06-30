@extends('layouts.master')

@section('title', 'Quên mật khẩu')

@section('menu')
    @include('components.menu')
@endsection

@section('content')
    <div class="contai">
        <div class="login">
            <div class="login__contain">
                <div class="login__img">
                    <img src="{{asset('images/forget_img.jpg')}}" />
                </div>
                <div class="login__form">
                    <h3 class="login__title">Quên mật khẩu</h3>

                    <hr>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group form-group-grid">
                            <label for="email" class="col-form-label">Địa chỉ email</label>

                            <div class="w-100">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-group-grid">
                            <label class="col-form-label"></label>

                            <div class="">
                                <button type="submit" class="btn__buy btn__buy-center">
                                    Gửi mật khẩu đến email
                                </button>
                            </div>
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
