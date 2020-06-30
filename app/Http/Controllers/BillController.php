<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Bill;
use App\Detail_bill;
use App\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailBuy;

class BillController extends Controller
{
    protected function checkoutCart(Request $request) {
        if(!Auth::user()) {
            return redirect()->back()->with('errCart', 'Bạn cần đăng nhập để mua hàng!');
        }

        if(count(session('cart', [])) == 0) {
            return redirect()->back()->with('errCart', 'Bạn chưa có sản phẩm nào trong giỏ hàng!');
        }

        // chạy lòng lặp để kiểm tra lần cuối xem sản phẩm có đủ để mua không
        foreach(session('cart') as $key => $cart) {
            $product = Product::find($key);

            // nếu số lượng trong giỏ hàng lớn hơn trong db thì quay lại
            if($cart['quantity'] > $product->quantity_product) {  
                return redirect()->back()->with('errQuantity', 
                "Sản phẩm $product->name_product không đủ với số lượng mà bạn chọn mua!"); 
            }
        }

        $id_bill = $this->randomIdBill(); // random để tạo id đơn hàng
        $id_member = Auth::user()->id_member; // lấy id của người mua

        Bill::create(['id_bill' => $id_bill, 'id_member' => $id_member]);  // tạo đơn hàng

        foreach(session('cart') as $key => $cart) { // tạo chi tiết đơn hàng
            $amount = $cart['quantity'] * $cart['price_product'];

            $data = ['id_bill' => $id_bill, 'id_product' => $key, 
                'quantity_buy' => $cart['quantity'], 'amount' => $amount];
                
            Detail_bill::create($data);
        }


        // Send mail
        $this->sendMailtoUserBuy();
        
        session()->forget('cart');
        return redirect()->back()->with('buySuccess', 'Mua hàng thành công!');
    }

    protected function randomIdBill() {
        $id = rand(10000, 99999999);
        $bill = Bill::find($id);

        if($bill === null) {
            return $id;
        }
        else {
            $this->randomIdBill();
        }
    }

    protected function sendMailtoUserBuy() {
        $total = \Helper::exec()->mathTotalCart();

        $datas = [
            'cart' => session('cart'),
            'total' => $total
        ];

        Mail::to(Auth::user()->email)->send(new SendMailBuy($datas));
    }
}
