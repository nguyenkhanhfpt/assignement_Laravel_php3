<div class="viewBill">
    @if(session('successBill'))
        <div class="alert alert-success m3-2">
            {{session('successBill')}}
        </div>
    @endif
    <div class="viewBill__info">
        <img src="{{ asset('images')}}/{{ $member->img_member }}" alt="">
        <div class="viewBill__info-right">
            <p><span>Họ tên:</span> {{ $member->name_member }}</p>
            <p><span>Địa chỉ:</span> {{ $member->address }}</p>
            <p><span>Số điện thoại:</span> {{ $member->phone_number }}</p>
            <p><span>Email:</span> {{ $member->email }}</p>
            <p><span>Tổng số đơn hàng đã mua:</span> {{ count($member->bill) }} đơn</p>
        </div>
    </div>

    <table class="table table_member table_bill mb-0">
        <thead>
            <tr>
                <th>Ảnh SP</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Màu</th>
                <th>Size</th>
                <th>Thành tiền</th>
                <th>Trạng thái</th>
                <th>Ngày mua</th>
            </tr>
        </thead>
        <tbody>
            @foreach($member->bills as $detail)
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
                    <td>
                        @if ($detail->bill->status == config('settings.rejected'))
                            <span class='badge badge-pill badge-danger'>Đã hủy</span>
                        @elseif ($detail->bill->status == config('settings.accepted'))
                            <span class='badge badge-pill badge-success'>Đã hoàn thành</span>
                        @elseif ($detail->bill->status == config('settings.running'))
                            <span class='badge badge-pill badge-warning'>Đang giao</span>
                        @else
                            <span class='badge badge-pill badge-info'>Đang chờ</span>
                        @endif
                    </td>
                    <td>
                        {{ $detail->bill->date_buy }}
                    </td>
                </tr>
            @endforeach

            <tr>
                <td colspan="8" class="font-weight-bold" style="font-size: 16px;">
                    Tổng tiền đơn hàng: <b class="total-amount">0 đ</b>
                </td>
            </tr>
        </tbody>
    </table>
</div>