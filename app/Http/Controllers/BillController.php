<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Bill;
use App\Detail_bill;
use App\Product;
use App\Size;
use App\Color;
use App\Code;
use App\User;
use Carbon\Carbon;
use App\Jobs\SendMailOrder;
use DB;
use Exception;
use App\Notifications\BuyProduct;
use Pusher\Pusher;

class BillController extends Controller
{
    protected function index(Request $request) {
        if(count(session('cart', [])) == 0) {
            return redirect()->back()->with('errCart', trans('view.cart.cart_empty'));
        }

        if(!Auth::user()) {
            return redirect()->back()->with('errCart', trans('view.cart.need_login'));
        }

        $member = Auth::user();
        $sessionCart = session('cart', []);
        $totalCart = $this->match_total();
        $totalCartSale = $this->match_total_sale();
        $carts = [];

        foreach ($sessionCart as $key => $cart) {
            $size = Size::find($cart['size']);
            $color = Color::find($cart['color']);

            if ($size) {
                $cart['size'] = $size->size;
            }

            if ($color) {
                $cart['color'] = $color->name;
            }

            $carts[$key] = $cart;
        }

        return view('checkout', compact(['carts', 'totalCart', 'member', 'totalCartSale']));
    }

    public function checkoutCart(Request $request)
    {
        foreach(session('cart') as $key => $cart) {
            $product = Product::findOrFail($cart['id']);

            if($cart['quantity'] > $product->quantity_product) {  
                return response()->json([
                    'status' => 400,
                    'message' => trans('view.payment.product_not_enough', 
                        ['product' => $product->name_product]) 
                ]);
            }
        }

        $member = Auth::user();

        DB::beginTransaction();

        try {
            $member->name_member = $request->name_member;
            $member->phone_number = $request->phone_number;
            $member->address = $request->address;
            $member->save();

            $bill = Bill::create([
                'member_id' => Auth::id(),
                'date_buy' => Carbon::now('Asia/Ho_Chi_Minh'),
                'status' => 0,
                'code_id' => session('code.id', null)
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

            DB::commit();

            // Send mail
            $this->sendMailtoUserBuy();

            // Send notifications to Admin
            $this->sendNotificationToAdmin();

            $this->realtimeNotification();    
            
            session()->forget('cart');
            session()->forget('code');

            return response()->json([
                'status' => 200,
                'message' => trans('view.payment.payment_success')
            ]);
        } catch(Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 400,
                'message' => trans('view.payment.payment_failed')
            ]);
        }
    }

    public function checkCode(Request $request)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $member = Auth::user()->load('bill');

        $code = Code::where('name', $request->code)
            ->where('start', '<' ,$now)
            ->where('end', '>' ,$now)
            ->first();

        if ($code) {
            foreach($member->bill as $bill) {
                if ($code->id == $bill->code_id) {
                    session(['code' => null]);
    
                    return response()->json([
                        'status' => 400,
                        'message' => 'Bạn đã sử dụng mã code này, vui lòng nhập mã khác!',
                        'totalCartSale' => number_format($this->match_total_sale()) . ' đ'
                    ]);
                }
            }

            if ($code->price < $this->match_total()) {
                session(['code' => $code]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Nhập mã code thành công!',
                    'totalCartSale' => number_format($this->match_total_sale()) . ' đ'
                ]);
            } else {
                session(['code' => '']);

                return response()->json([
                    'status' => 400,
                    'message' => 'Tổng tiền của đơn hàng không đủ để sử dụng mã này!',
                    'totalCartSale' => number_format($this->match_total_sale()) . ' đ'
                ]);
            }
        } else {
            session(['code' => '']);

            return response()->json([
                'status' => 400,
                'message' => 'Nhập mã code không đúng!',
                'totalCartSale' => number_format($this->match_total_sale()) . ' đ'
            ]);
        }
    }

    public function sendMailtoUserBuy() {
        $total = $this->match_total_sale();
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

    public function sendNotificationToAdmin()
    {
        $member = User::where('email', config('settings.mail_admin'))->firstOrFail();

        $data = [
            'member_id' => Auth::id()
        ];

        Notification::send($member, new BuyProduct($data));
    }

    public function realtimeNotification()
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
          );
          $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
          );
        
        $data['message'] = 'hello world';
        $pusher->trigger('notification-channel', 'notification-event', $data);
    }

    protected function match_total(){
        $total = 0;
        foreach(session('cart', []) as $key => $value) {
            $total += $value['quantity'] * $value['price_product'];
        }
        return $total;
    }

    protected function match_total_sale(){
        $total = 0;
        foreach(session('cart', []) as $key => $value) {
            $total += $value['quantity'] * $value['price_product'];
        }
        return $total - session('code.price', 0);
    }
}
