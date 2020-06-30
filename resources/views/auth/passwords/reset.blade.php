@extends('layouts.master')

@section('title', 'Đặt lại mật khẩu')

@section('menu')
    @include('components.menu')
@endsection

@section('content')
    <div class="contai">
        <div class="login register">
            <div class="login__contain">
                <div class="login__img">
                    <img src="{{asset('images/update_img.jpg')}}" />
                </div>
                <div class="login__form">
                    <h3 class="login__title">Cập nhật mật khẩu</h3>

                    <hr>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">


                        <div class="form-group form-group-grid">
                            <label for="email" class="col-form-label">Địa chỉ Email</label>

                            <div class="w-100">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group form-group-grid">
                            <label class="col-form-label"></label>

                            <div class="">
                                <button type="submit" class="btn__buy btn__buy-center">
                                    Cập nhật mật khẩu
                                </button>
                            </div>
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
