<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class WishlistController extends Controller
{
    protected function index() {
        return view('wishlist');
    }

    protected function addWish(Request $request) {
        $id_product = $request->id_product;
        $product = Product::find($id_product);

        if($product == null) {
            return 'false';
        }

        $data = ['img_product' => $product->img_product, 
            'name_product' => $product->name_product, 
            'price_product' => $this->match_price($product->price_product, $product->sale)
        ];

        session()->put("wishList.$id_product", $data);
        
        return 'success';
    }

    protected function deleteWish($id) {
        session()->forget("wishList.$id");

        return redirect()->back();
    }

    protected function match_price($price, $sale) {
        $result = $price - ($price / 100 * $sale);
        return $result;
    }

}
