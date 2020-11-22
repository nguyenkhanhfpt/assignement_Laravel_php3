<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Bill;
use App\Detail_bill;
use App\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailBuy;
use Carbon\Carbon;
use App\Jobs\SendMailOrder;

class BillController extends Controller
{
    protected function checkoutCart(Request $request) {
        if(!Auth::user()) {
            return redirect()->back()->with('errCart', 'Bạn cần đăng nhập để mua hàng!');
        }

        if(count(session('cart', [])) == 0) {
            return redirect()->back()->with('errCart', 'Bạn chưa có sản phẩm nào trong giỏ hàng!');
        }

        foreach(session('cart') as $key => $cart) {
            $product = Product::find($cart['id']);

            if($cart['quantity'] > $product->quantity_product) {  
                return redirect()->back()->with('errQuantity', 
                "Sản phẩm $product->name_product không đủ với số lượng mà bạn chọn mua!"); 
            }
        }

        $bill = Bill::create([
            'member_id' => Auth::id(),
            'date_buy' => Carbon::now('Asia/Ho_Chi_Minh'),
            'status' => 0
        ]);

        foreach(session('cart') as $key => $cart) {
            $amount = $cart['quantity'] * $cart['price_product'];

            $bill->detail_bill()->create([
                'product_id' => $cart['id'],
                'size_id' => $cart['size'],
                'color_id' => $cart['color'],
                'quantity_buy' => $cart['quantity'],
                'amount' => $amount,
            ]);
        }

        // Send mail
        $this->sendMailtoUserBuy();
        
        session()->forget('cart');
        return redirect()->back()->with('buySuccess', 'Mua hàng thành công!');
    }

    public function sendMailtoUserBuy() {
        $total = \Helper::exec()->mathTotalCart();
        $email = Auth::user()->email;
        $date = date('d-m-Y');

        $datas = [
            'cart' => session('cart'),
            'total' => $total,
            'email' => $email,
            'date' => $date
        ];

        SendMailOrder::dispatch($datas);
    }
}
