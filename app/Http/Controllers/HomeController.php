<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use DB;

class HomeController extends Controller
{
    protected $limit_col = 8;

    protected function index() {
        $datas = Product::allProduct()->take(config('settings.limit'))->get();

        // Select sản phẩm được đề xuất
        $nominationPro = Product::allProduct()
            ->where('nomination', 1)
            ->take(config('settings.limit'))
            ->get();
        
        // Sắp xếp theo ngày nhập
        $newProducts = Product::allProduct()
            ->orderBy('date', 'desc')
            ->take(config('settings.limit') * 2)
            ->get();

        // Sắp xếp theo view
        $productView = Product::allProduct()
            ->orderBy('view', 'desc')
            ->take(config('settings.limit'))
            ->get();

        // Select danh mục sản phẩm
        $categories = Category::with('products')->get();
        
        return view('home', compact(['datas','nominationPro','newProducts', 'productView', 'categories']));
    }
}
