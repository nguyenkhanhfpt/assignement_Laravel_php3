<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;

class CartController extends Controller
{
    protected function index() {
        $sessionCart = session('cart', []);
        $totalCart = $this->match_total();

        return view('cart', [
            'sessionCart' => $sessionCart,
            'totalCart' => $totalCart
        ]);
    }

    protected function checkQuantityPro(Request $request) {
        $id = $request->id_product;
        $quantity = $request->quantity ? $request->quantity : 1; // nếu được thêm bằng nút 'ADD TO CART' thì quantity mặc định = 1

        $product = Product::find($id);

        if($quantity > $product->quantity_product) {
            return 'false';
        }
        else {
            return 'true';
        }
    }

    protected function addCart(Request $request) {
        $id = $request->id_product;
        $quantity = $request->quantity ? $request->quantity : 1; // nếu được thêm bằng nút 'ADD TO CART' thì quantity mặc định = 1

        $product = Product::find($id);

        // Nếu được thêm vào bằng trang viewProduct thì check số lượng ở đây
        if($request->has('quantity')) {
            if($quantity > $product->quantity_product) {
                return redirect()->back()->with('notEnough', 'Số lượng sản phẩm không đủ');
            }
        }

        if(session()->has("cart.$id")) {
            $newSession = session("cart.$id");
            $newSession['quantity'] += $quantity;

            session(["cart.$id" => $newSession]);
        }
        else {
            session()->put("cart.$id", ['img_product' => $product->img_product, 
                'name_product' => $product->name_product, 
                'quantity' => $quantity,
                'price_product' => $this->match_price($product->price_product, $product->sale)
                ]
            );
        }

        if($request->quantity) {
            return redirect()->back();
        }

        //Nếu thêm vào giỏ hàng bằng nút thì trả về data
        $data = [
            'count' => count(session('cart')),
            'total' => $this->match_total()
        ];

        return $data;
    }

    protected function viewCart() {
        return view('components.cart');
    }

    protected function deleteCart($id) {
        session()->forget("cart.$id");
        return redirect()->route('cart');
    }

    protected function undateCart(Request $request) {
        $arr = $request->quantity;

        foreach($arr as $key => $num) {
            $product = Product::find($key);

            // Kiểm tra nếu số lượng truyền vào lớn hơn trong DB thì không thức hiện update
            if($num > $product->quantity_product) {
                $request->session()->flash('errQuantity', "Số lượng sản phẩm $product->name_product không đủ!");    
                continue;
            }

            if($num > 0) {
                $newSession = session("cart.$key");

                $newSession['quantity'] = $num;
        
                session(["cart.$key" => $newSession]);
            }
        }

        return redirect()->route('cart');
    }

    protected function match_price($price, $sale) {
        $result = $price - ($price / 100 * $sale);
        return $result;
    }

    protected function match_total(){
        $total = 0;
        foreach(session('cart', []) as $key => $value) {
            $total += $value['quantity'] * $value['price_product'];
        }
        return $total;
    }
}
