@extends('layouts.adminMaster')

@section('menu')
    @include('components.menuAdmin')
@endsection

@section('content')
    <h2 class="text-center admin__title">Lịch sử mua hàng của thành viên</h2>

    <div class="box">
        <div class="row">
            <div class="col-3">
                <div class="detail-member">
                    <img src="{{asset('images')}}/{{$member->img_member}}" alt="">
                    <h3 class="detail-member-name">{{ $member->name_member }}</h3>
                    <p>{{$member->phone_number}}</p>
                    <p>{{$member->email}}</p>
                    <p>{{$member->address}}</p>
                </div>
            </div>
            <div class="col-9">
                <table class="table table__detail-member mb-5">
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
                        @if(count($bills) == 0)
                            <tr>
                                <td>
                                    Thành viên chưa mua sản phẩm nào
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>    


    </div>
    

@endsection