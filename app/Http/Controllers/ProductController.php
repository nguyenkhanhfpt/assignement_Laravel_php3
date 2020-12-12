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
        $products = Product::allProduct()
            ->where('name_product', 'LIKE', '%'. $request->q .'%')
            ->paginate(config('settings.limit_products'));

         // Sắp xếp theo view
         $productView = Product::allProduct()
            ->orderBy('view', 'desc')
            ->take(config('settings.limit_view'))
            ->get();

        // Select danh mục sản phẩm
        $categories = Category::with('products')->get();

        return view('products.products', compact(['products', 'productView', 'categories']));
    }

    public function search(Request $request)
    {
        $products = Product::allProduct()
            ->where('name_product', 'LIKE', '%'. $request->q .'%')
            ->paginate(config('settings.limit_products'));

        return view('components.productSearch', compact('products'));
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
