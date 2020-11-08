<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\ProductImage;
use DB;

class ProductController extends Controller
{
    protected function index() {
        $products = Product::all()->load('images');

        return view('admins.products', [
            'products' => $products
        ]);
    }

    protected function viewAdd() {
        $categories = Category::all();

        return view('admins.addProduct', [
            'categories' => $categories
        ]);
    }

    protected function validateInsert($request) {
        $request->validate([
            'name_product' => 'required|unique:products',
            'id_category' => 'required',
            'price_product' => 'required|integer|min:1',
            'img_product' => 'required',
            'quantity_product' => 'required|integer|min:1',
            'img_product_2' => 'required',
            'img_product_3' => 'required',
            'decscription' => 'required'
        ], [
            'name_product.required' => 'Tên sản phẩm không được để trống',
            'name_product.unique' => 'Tên sản phẩm đã có trong cửa hàng',
            'id_category.required' => 'Tên danh mục không được để trống',
            'price_product.min' => 'Sản phẩm không được nhỏ hơn 1',
            'img_product.required' => 'Ảnh sản phẩm không được để trống',
            'quantity_product.required' => 'Số lượng sản phẩm không được để trống',
            'quantity_product.min' => 'Số lượng sản phẩm không được nhỏ hơn 1',
            'img_product_2.required' => 'Ảnh sản phẩm không được để trống',
            'img_product_3.required' => 'Ảnh sản phẩm không được để trống',
            'decscription.required' => 'Mô tả sản phẩm không được để trống'
        ]);
    }

    protected function insert(Request $request) {
        $this->validateInsert($request);

        $file = $request->img_product;
        $file2 = $request->img_product_2;
        $file3 = $request->img_product_3;

        $img_product = $file->getClientOriginalName();
        $img_product_2 = $file2->getClientOriginalName();
        $img_product_3 = $file3->getClientOriginalName();

        $file->move('images/products', $img_product);
        $file2->move('images/products', $img_product_2);
        $file3->move('images/products', $img_product_3);

        $imagesUpload = [
            $img_product,
            $img_product_2,
            $img_product_3
        ];

        //return response()->json($imagesUpload);

        $datas = [];
        
        $id = vn_to_eng($request->name_product);

        $datas['id_product'] = $id;
        $datas['name_product'] = $request->name_product;
        $datas['id_category'] = $request->id_category;
        $datas['price_product'] = floatval($request->price_product);
        $datas['sale'] = $request->sale || 0;
        $datas['view'] = 0;
        $datas['quantity_product'] = intval($request->quantity_product);
        $datas['decscription'] = $request->decscription;
        $datas['nomination'] = $request->nomination ? 1 : 0;

        Product::create($datas);

        $product = Product::find($id);

        foreach ($imagesUpload as $image) {
            $product->images()->create([
                'image' => $image
            ]);
        }

        return redirect(route('adminProduct'));
    }

    protected function delete($id) {
        $product = Product::findOrFail($id);

        $product->images()->delete();
        $product->delete();

        return redirect(route('adminProduct'));
    }

    protected function viewUpdate($id) {
        $product = Product::find($id);
        $categories = Category::all();
        $product = DB::table('products')
                ->join('categories', 'categories.id_category', '=', 'products.id_category')
                ->where('id_product', '=', $id)->first();

        return view('admins.updateProduct', [
            'product' => $product, 
            'categories' => $categories
        ]);
    }

    protected function validateUpdate($request) {
        $request->validate([
            'name_product' => 'required',
            'id_category' => 'required',
            'price_product' => 'required|integer|min:1',
            'quantity_product' => 'required|integer|min:0',
            'decscription' => 'required'
        ], [
            'name_product.required' => 'Tên sản phẩm không được để trống',
            'id_category.required' => 'Tên danh mục không được để trống',
            'price_product.min' => 'Sản phẩm không được nhỏ hơn 1',
            'quantity_product.required' => 'Số lượng sản phẩm không được để trống',
            'quantity_product.min' => 'Số lượng sản phẩm không được nhỏ hơn 1',
            'decscription.required' => 'Mô tả sản phẩm không được để trống'
        ]);
    }

    protected function update(Request $request, $id) {
        $this->validateUpdate($request);

        $product = Product::find($id);

        $product->name_product = $request->name_product;
        $product->id_category = $request->id_category;
        $product->price_product = $request->price_product;
        $product->sale = $request->sale;
        $product->quantity_product = $request->quantity_product;
        $product->decscription = $request->decscription;
        $product->nomination = $request->nomination || 0;


        if($request->hasFile('img_product')) {
            $file = $request->img_product;
            $img_product = $file->getClientOriginalName();
            $file->move('images', $img_product);

            $product->img_product = $img_product;
        }
        if($request->hasFile('img_product_2')) {
            $file = $request->img_product_2;
            $img_product_2 = $file->getClientOriginalName();
            $file->move('images', $img_product_2);

            $product->img_product_2 = $img_product_2;
        }
        if($request->hasFile('img_product_3')) {
            $file = $request->img_product_3;
            $img_product_3 = $file->getClientOriginalName();
            $file->move('images', $img_product_3);

            $product->img_product_3 = $img_product_3;
        }

        $product->save();

        return redirect()->back();
    }
}
