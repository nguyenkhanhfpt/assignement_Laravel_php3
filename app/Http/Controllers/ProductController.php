<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Comment;
use DB;


class ProductController extends Controller
{
    protected function index(Request $request) {
        if($request->has('category')) {
            $products = DB::table('products')
            ->join('categories', 'categories.id_category', '=', 'products.id_category')
            ->where('products.id_category', '=', $request->category)->get();
        }
        else {
            $products = DB::table('products')
                ->join('categories', 'categories.id_category', '=', 'products.id_category')
                ->paginate(12);
        }

        // Sắp xếp theo view
        $productView = DB::table('products')
            ->join('categories', 'categories.id_category', '=', 'products.id_category')
            ->orderByRaw('view DESC')->limit(5)->get();

         // Select danh mục sản phẩm
         $categories = DB::table('products as pr')
            ->select('ca.id_category', 'ca.name', DB::raw('COUNT(pr.id_category) as total'))
            ->rightJoin('categories as ca', 'ca.id_category', '=', 'pr.id_category')
            ->groupBy('ca.id_category')
            ->get();

        return view('products.products', compact(['products', 'productView', 'categories']));
    }

    protected function viewProduct($id) {
        $product = Product::find($id);
        $comments = DB::table('comments as C')
            ->join('members as M', 'C.id_member', '=', 'M.id_member')
            ->select('C.id_comment', 'C.content', 'C.id_member', 'C.date_comment', 'M.name_member', 'M.img_member')
            ->where('C.id_product', '=', $id)
            ->orderBy('C.date_comment', 'DESC')
            ->get();

        $productCategory = DB::table('products')
            ->join('categories', 'categories.id_category', '=', 'products.id_category')
            ->where('products.id_category', '=', $product->id_category)->limit(5)->get();

        $product->view += 1;
        $product->save();

        return view('products.viewProduct', compact(['comments', 'productCategory']), [
            'product' => $product
        ]);
    }
}
