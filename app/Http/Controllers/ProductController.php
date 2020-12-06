<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Comment;
use DB;


class ProductController extends Controller
{
    protected function index(Request $request) {
        if($request->has('category')) {
            $products = Category::find($request->category)->products()
                ->paginate(config('settings.limit_products'));
        }
        else {
            $products = Product::allProduct()->paginate(config('settings.limit_products'));
        }

        // Sắp xếp theo view
        $productView = Product::allProduct()
            ->orderBy('view', 'desc')
            ->take(config('settings.limit_view'))
            ->get();

         // Select danh mục sản phẩm
         $categories = Category::with('products')->get();

        return view('products.products', compact(['products', 'productView', 'categories']));
    }

    protected function find(Request $request) {
        if($request->has('q')) {
            $products = DB::table('products')
            ->join('categories', 'categories.id_category', '=', 'products.id_category')
            ->where('products.name_product', 'LIKE', '%'. $request->q .'%')
            ->paginate(12);
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

    protected function viewProduct($slug) {
        $product = Product::where('slug', $slug)
            ->first()->load(['images', 'category', 'comments' => function($query) {
                $query->orderBy('date_comment', 'desc');
            }, 
            'comments.member', 'sizes', 'colors']);

        $idCate = $product->category->id;

        $comments = $product->comments;

        $productCategory = Category::find($idCate)
            ->products
            ->take(config('setting.limit'))
            ->load(['images', 'category']);

        $product->view += 1;
        $product->save();

        return view('products.viewProduct', compact(['comments', 'productCategory', 'product']));
    }
}
