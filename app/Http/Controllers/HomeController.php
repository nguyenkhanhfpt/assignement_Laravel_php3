<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    protected $limit_col = 8;

    protected function index() {
        $datas = DB::table('products')
            ->join('categories', 'categories.id_category', '=', 'products.id_category')
            ->limit($this->limit_col)->get();

        // Select sản phẩm được đề xuất
        $nominationPro = DB::table('products')
            ->join('categories', 'categories.id_category', '=', 'products.id_category')
            ->where('nomination', 1)->limit($this->limit_col)->get();

        // Sắp xếp theo ngày nhập
        $newProducts = DB::table('products')
            ->join('categories', 'categories.id_category', '=', 'products.id_category')
            ->orderByRaw('date DESC')->get();

        // Sắp xếp theo view
        $productView = DB::table('products')
            ->join('categories', 'categories.id_category', '=', 'products.id_category')
            ->orderByRaw('view DESC')->limit($this->limit_col)->get();

        // Select danh mục sản phẩm
        $categories = DB::table('products as pr')
            ->select('ca.id_category', 'ca.name', 'ca.img_category', DB::raw('COUNT(pr.id_category) as total'))
            ->rightJoin('categories as ca', 'ca.id_category', '=', 'pr.id_category')
            ->groupBy('ca.id_category')
            ->get();

        
        return view('home', compact(['datas','nominationPro','newProducts', 'productView', 'categories']), [
            'limit_col' => $this->limit_col
        ]);

    }
}
