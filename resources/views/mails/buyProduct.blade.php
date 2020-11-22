@component('mail::message')
# Thông tin đơn hàng của bạn

## Tổng tiền: {{ number_format($datas['total']) }} đ

@component('mail::table')
<tr>
    <th>Tên sản phẩm</th>
    <th>Số lượng</th>
    <th>Thành tiền</th>
</tr>
@foreach($datas['cart'] as $key => $cart)
    <tr>
        <td style="padding-left: 20px">{{ $cart['name_product'] }}</td>
        <td style="text-align: center;">{{ $cart['quantity'] }}</td>
        <td>{{ number_format($cart['price_product'] * $cart['quantity']) }} đ</td>
    </tr>
@endforeach
@endcomponent

@endcomponent
