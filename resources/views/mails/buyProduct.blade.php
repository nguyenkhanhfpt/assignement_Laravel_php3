<h3>Cảm ơn bạn đã mua sản phẩm của chúng tôi</h3>

<table border='1' style="border-collapse:collapse;text-align:center">
    <thead>
        <tr>
            <th style="padding: 10px; background-color: #4fb68d;">Tên sản phẩm</th>
            <th style="padding: 10px; background-color: #4fb68d;">Số lượng mua</th>
            <th style="padding: 10px; background-color: #4fb68d;">Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        @foreach($datas['cart'] as $key => $cart)
            <tr>
                <td style="padding: .8rem">
                    {{ $cart['name_product'] }}
                </td>
                <td style="padding: .8rem">
                    {{ $cart['quantity'] }}
                </td>
                <td style="padding: .8rem">
                    {{ number_format($cart['quantity'] * $cart['price_product']) }} đ
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h3>Tổng số tiền thanh toán là: <span style="color: #f00">{{ number_format($datas['total']) }} đ</span></h3>