<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class RestAPIController extends Controller
{
    function selectAllProduct() {
        $products = Product::all();

        return response()->json($products);
    }

    function selectOneProduct(Request $request) {
        $product = Product::find($request->id_product);

        return response()->json($product);
    }

    function deleteProduct($id) {
        $result = Product::find($id);

        if($result) {
            $result->delete();
            return response()->json(['success' => 'Xóa hàng thành công!']);
        }
        else {
            return response()->json(['error' => 'Xóa hàng không thành công!']);
        }
    }
}
