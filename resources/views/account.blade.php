@extends('layouts.master')

@section('title', 'Ecolife - Tài khoản')

@section('menu')
    @include('components.menu')
@endsection

@section('content')
    <div class="header__banner">
        <div class="header__banner-content">
            <h2>@lang('view.account.your_account')</h2>
            <div class="header__banner-sortlink">
                <a href={{route('home')}}>@lang('view.home')</a>
                <span>
                    <i class="fal fa-angle-right"></i>
                </span>
                <a href={{route('account')}}>@lang('view.account.account')</a>
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
                        <p>@lang('view.account.info_account')</p>
                        <h6>{{$user->name_member}}</h6>
                    </div>
                </div>

                <!-- menu boostrap tab -->
                <div class="nav flex-column nav-pills mt-5 mb-4" id="account" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-profile" role="tab" 
                        aria-controls="v-pills-home" aria-selected="true">@lang('view.account.info_account')</a>

                    <a class="nav-link" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" 
                        aria-controls="v-pills-password" aria-selected="false">@lang('view.account.change_pass')</a>

                    <a class="nav-link" id="v-pills-buy-tab" data-toggle="pill" href="#v-pills-buy" role="tab" 
                        aria-controls="v-pills-buy" aria-selected="false">@lang('view.account.history')</a>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <!-- Nội dung của boostrap tab -->
                <div class="tab-content" id="account">

                    <!-- Phần thông tin tài khoản -->
                    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <h5 class="account__title">@lang('view.account.info_account')</h5>

                        @if(session('successUpdate'))
                            <p class="success">{{ session('successUpdate') }}</p>
                        @endif

                        <div class="border bg-white rounded p-3">
                            <form action="{{route('updateProfile')}}" method="POST" class="form_info" 
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="name_member" class="col-sm-2 col-form-label">@lang('view.account.name') </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name_member') is-invalid @enderror" name="name_member" 
                                        id="name_member" value="{{$user->name_member}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone_number" class="col-sm-2 col-form-label">@lang('view.account.phone')</label>
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
                                    <label for="address" class="col-sm-2 col-form-label">@lang('view.account.address')</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" 
                                        name="address" value="{{$user->address}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="img_member" class="col-sm-2 col-form-label">@lang('view.account.change_img')</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="img_member" class="form-control-file" id="img_member">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <input type="submit" class="btn__buy" value="@lang('view.account.update')">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Phần thay đổi mật khẩu -->
                    <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                        <h5 class="account__title">@lang('view.account.change_pass')</h5>
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
                                    <label for="oldPass" class="col-sm-2 col-form-label">@lang('view.account.old_pass')</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="oldPass" name="oldPass" 
                                        placeholder="@lang('view.account.your_pass')">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="newPass" class="col-sm-2 col-form-label">@lang('view.account.new_pass')</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password" id="newPass" 
                                        placeholder="@lang('view.account.8_pass')">
                                    </div>
                                </div>
                                <div class=" form-group row">
                                        <label for="newPassAgain" class="col-sm-2 col-form-label">@lang('view.account.again_pass')</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="newPassAgain" name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <input type="submit" class="btn__buy" value="@lang('view.account.update')">
                                        </div>
                                    </div>
                            </form>

                        </div>
                    </div>

                    <!-- Phần lịch sử mua hàng -->
                    <div class="tab-pane fade" id="v-pills-buy" role="tabpanel" aria-labelledby="v-pills-buy-tab">
                        <h5 class="account__title">@lang('view.account.history')</h5>
                        <div class="table-responsive mb-5">
                            <table class="table table_member table_bill">
                                <thead>
                                    <tr>
                                        <th>@lang('view.account.img')</th>
                                        <th>@lang('view.account.product')</th>
                                        <th>@lang('view.account.quantity')</</th>
                                        <th>@lang('view.account.color')</th>
                                        <th>Size</th>
                                        <th>@lang('view.account.price')</th>
                                        <th class="text-center">@lang('view.account.status')</th>
                                        <th>@lang('view.account.date')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bills as $detail)
                                        <tr>
                                            <td>
                                                <img src="{{ Helper::exec()->getFirstImage($detail->product->images) }}" alt="">
                                            </td>
                                            <td>
                                                {{ $detail->product->name_product }}
                                            </td>
                                            <td class="text-center">
                                                {{ $detail->quantity_buy }}
                                            </td>
                                            <td class="text-center">
                                                {{ $detail->color ? $detail->color->name : '' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $detail->size ? $detail->size->size : '' }}
                                            </td>
                                            <td>
                                                {{ number_format($detail->amount)}} đ
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->bill->status == config('settings.rejected'))
                                                    <span class='badge badge-pill badge-danger'>@lang('view.account.rejected')</span>
                                                @elseif ($detail->bill->status == config('settings.accepted'))
                                                    <span class='badge badge-pill badge-success'>@lang('view.account.accepted')</span>
                                                @elseif ($detail->bill->status == config('settings.running'))
                                                    <span class='badge badge-pill badge-warning'>@lang('view.account.running')</span>
                                                @else
                                                    <span class='badge badge-pill badge-info'>@lang('view.account.pedding')</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $detail->bill->date_buy }}
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