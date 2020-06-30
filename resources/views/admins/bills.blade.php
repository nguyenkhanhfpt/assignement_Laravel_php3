@extends('layouts.adminMaster')

@section('menu')
    @include('components.menuAdmin')
@endsection

@section('content')
    <h2 class="text-center admin__title">Đơn hàng</h2>

    <div class="d-flex justify-content-between">
        <form action="{{route('adminBill')}}" method="GET" id="orderBy">
            <select class="form-control orderBy" name="orderBy">
                <option value="">Tất cả</option>
                <option value="completed">Hoàn thành</option>
                <option value="pedding">Đang chờ</option>
                <option value="cancelled">Bị hủy</option>
            </select>
        </form>
        <form action="{{route('adminBill')}}" method="GET">
            <input type="text" class="form-control" name="find" placeholder="Tìm mã hóa đơn">
        </form>
    </div>
    

    <div class="box">
        <div class="box__bill">
            @foreach($bills as $bill)
                <div class="bill">
                    <div class="d-flex">
                        <img src="{{asset('images')}}/{{$bill->img_member}}" alt="">
                        <div class="ml-2">
                            <p class="font-weight-bold mb-0">{{$bill->name_member}}</p>
                            <span class="small text-secondary">{{$bill->date_buy}}</span>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <p class="small-14 mb-1">Mã đơn hàng: #{{$bill->id_bill}}</p>
                        <p class="small-14 mb-1">Số sản phẩm mua: {{$bill->totalPro}}</p>
                        <p class="small-14">Tổng tiền: {{number_format($bill->amount)}} đ</p>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        @if($bill->status == -1) 
                            <div class="status cancel">
                                Bị hủy
                            </div>
                        @elseif($bill->status == 1) 
                            <div class="status finish">
                                Hoàn thành
                            </div>
                        @else 
                            <div class="status pedding">
                                Đang chờ
                            </div>
                        @endif
                        <a href="{{route('adminBill')}}/{{$bill->id_bill}}" class="view__bill">Xem đơn hàng</a>
                    </div>
                </div>
            @endforeach

        </div>

    </div>

    <script>
        $( ".orderBy" ).change(function() {
            $('#orderBy').submit();
        });
    </script>

@endsection
