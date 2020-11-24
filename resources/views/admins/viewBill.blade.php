<div class="viewBill">
    @if(session('successBill'))
        <div class="alert alert-success m3-2">
            {{session('successBill')}}
        </div>
    @endif
    <div class="viewBill__info">
        <img src="{{ asset('images')}}/{{ $bill->member->img_member }}" alt="">
        <div class="viewBill__info-right">
            <p><span>Họ tên:</span> {{ $bill->member->name_member }}</p>
            <p><span>Địa chỉ:</span> {{ $bill->member->address }}</p>
            <p><span>Số điện thoại:</span> {{ $bill->member->phone_number }}</p>
            <p><span>Email:</span> {{ $bill->member->email }}</p>
            <p><span>Mã hóa đơn:</span> #{{ $bill->id }}</p>
            <p><span>Thời gian mua:</span> {{ $bill->date_buy }}</p>
        </div>
    </div>

    <table class="table table_member table_bill mb-0">
        <thead>
            <tr>
                <th>Ảnh sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Màu</th>
                <th>Size</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bill->detail_bill as $detail)
                <tr>
                    <td>
                        <img src="{{ Helper::exec()->getFirstImage($detail->product->images) }}" alt="">
                    </td>
                    <td>
                        {{ $detail->product->name_product }}
                    </td>
                    <td>
                        {{ $detail->quantity_buy }}
                    </td>
                    <td>
                        {{ $detail->color ? $detail->color->name : '' }}
                    </td>
                    <td>
                        {{ $detail->size ? $detail->size->size : '' }}
                    </td>
                    <td>
                        {{ number_format($detail->amount)}} đ
                    </td>
                </tr>
            @endforeach

            <tr>
                <td colspan="5" class="font-weight-bold" style="font-size: 16px;">
                    Tổng tiền đơn hàng: <b class="total-amount">{{ number_format($bill->total) }} đ</b>
                </td>
                <td>
                    <form action="{{route('updateBill')}}" method="post" class="d-flex align-items-end">
                        @csrf
                        <input type="hidden" name="id_bill" value={{$bill->id}}>
                        <div class="form-group mb-0">
                            <select class="form-control" name="status" id="status">
                                @if($bill->status == config('accepted')) 
                                    <option value="{{$bill->status}}" selected >Hoàn thành</option>
                                @elseif($bill->status == config('running')) 
                                    <option value="{{$bill->status}}" selected >Đang chuyển</option>
                                @elseif($bill->status == config('rejected'))
                                    <option value="{{$bill->status}}" selected >Bị hủy</option>
                                @else
                                    <option value="{{$bill->status}}" selected >Đang chờ</option>
                                @endif
                                <option value="1">Hoàn thành</option>
                                <option value="0">Đang chờ</option>
                                <option value="-1">Bị hủy</option>
                            </select>
                        </div>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>

</div>

    

