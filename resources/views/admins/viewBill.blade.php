@extends('layouts.adminMaster')

@section('menu')
    @include('components.menuAdmin')
@endsection

@section('content')
    <h2 class="text-center admin__title">Chi tiết đơn hàng</h2>

    <div class="box--maxWidth">
        <div class="viewBill">
            @if(session('successBill'))
                <div class="alert alert-success m3-2">
                    {{session('successBill')}}
                </div>
            @endif
            <div class="viewBill__info">
                <img src="{{asset('images')}}/user.jpg" alt="">
                <div class="viewBill__info-right">
                    <p><span>Họ tên:</span> {{$info->name_member}}</p>
                    <p><span>Địa chỉ:</span> {{ $info->address }}</p>
                    <p><span>Số điện thoại:</span> {{ $info->phone_number }}</p>
                    <p><span>Email:</span> {{ $info->email }}</p>
                    <p><span>Mã hóa đơn:</span> #{{ $info->id_bill }}</p>
                    <p><span>Thời gian mua:</span> {{ $info->date_buy }}</p>
                </div>
            </div>

            <table class="table table_member table_bill">
                <thead>
                    <tr>
                        <th></th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Số tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productsBuy as $product)
                        <tr>
                            <td>
                                <img src="{{asset('images')}}/{{$product->img_product}}" alt="">
                            </td>
                            <td>
                                {{$product->name_product}}
                            </td>
                            <td>
                                {{$product->quantity_buy}}
                            </td>
                            <td>
                                {{number_format($product->amount)}} đ
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="3" class="font-weight-bold" style="font-size: 16px;">
                            Tổng tiền
                        </td>
                        <td colspan="4" class="total-amount">
                            {{number_format($sumAmount->total)}} đ
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        @if($info->status < 1)
            <form action="{{route('updateBill')}}" method="post" class="d-flex align-items-end">
                @csrf
                <input type="hidden" name="id_bill" value={{$info->id_bill}}>
                <div class="form-group mb-0">
                    <label for="status">Trạng thái của đơn hàng</label>
                    <select class="form-control" name="status" id="status">
                        @if($info->status == 1) 
                            <option value="{{$info->status}}" selected >Hoàn thành</option>
                        @elseif($info->status == -1)
                            <option value="{{$info->status}}" selected >Bị hủy</option>
                        @else
                            <option value="{{$info->status}}" selected >Đang chờ</option>
                        @endif
                        <option value="1">Hoàn thành</option>
                        <option value="0">Đang chờ</option>
                        <option value="-1">Bị hủy</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary ml-2" data-toggle="tooltip" data-placement="top" 
                title="Cập nhật tình trạng của đơn hàng">
                    Cập nhật
                </button>
            </form>
        @endif

        <a href="{{route('adminBill')}}/delete/{{$info->id_bill}}" onClick="return confirm('Bạn có muốn xóa đơn hàng!')" class="btn btn-danger mt-4">Xóa đơn hàng</a>

    </div>
    

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

@endsection