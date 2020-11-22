<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Color;
use App\Size;
use Helper;

class CartController extends Controller
{
    protected function index() {
        $sessionCart = session('cart', []);
        $totalCart = $this->match_total();
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

        return view('cart', [
            'sessionCart' => $carts,
            'totalCart' => $totalCart
        ]);
    }

    protected function checkQuantityPro(Request $request) {
        $id = $request->id_product;
        $quantity = $request->quantity ? $request->quantity : 1; // nếu được thêm bằng nút 'ADD TO CART' thì quantity mặc định = 1

        $product = Product::find($id);

        if($quantity > $product->quantity_product) {
            return false;
        }
        else {
            return true;
        }
    }

    protected function addCart(Request $request) {
        $id = $request->id_product;
        $quantity = $request->quantity ? $request->quantity : 1; // nếu được thêm bằng nút 'ADD TO CART' thì quantity mặc định = 1
        $size = $request->size;
        $color = $request->color;
        $idCart = $id . $size . $color;

        $product = Product::find($id);

        if(session()->has("cart.$idCart")) {
            $newSession = session("cart.$idCart");
            $newSession['quantity'] += $quantity;

            session(["cart.$idCart" => $newSession]);
        }
        else {
            session()->put("cart.$idCart", [
                'id' => $id,
                'img_product' => Helper::exec()->getFirstImage($product->images), 
                'name_product' => $product->name_product, 
                'slug' => $product->slug,
                'quantity' => $quantity,
                'price_product' => $this->match_price($product->price_product, $product->sale),
                'size' => $size,
                'color' => $color
                ]
            );
        }

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

    protected function undateCart(Request $request, $idCart, $idProduct) {
        $quantity = $request->quantity;

        $product = Product::find($idProduct);

        if ($quantity > $product->quantity_product) {
            return response()->json(['status' => '402', 'message' => "Số lượng sản phẩm $product->name_product không đủ!"]);
        }

        if($quantity > 0) {
            $newSession = session("cart.$idCart");

            $newSession['quantity'] = $quantity;
    
            session(["cart.$idCart" => $newSession]);

            return response()->json([
                'status' => '200', 
                'message' => "Cập nhật số lượng sản phẩm $product->name_product thành công!",
                'price_product' =>  number_format($newSession['quantity'] * $newSession['price_product']) .' đ',
                'match_total' => number_format($this->match_total()) .' đ'
            ]);
        }
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
