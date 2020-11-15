<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;
use App\Product;
use App\ProductImage;
use App\Library;
use DB;
use Exception;

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
            'category_id' => 'required',
            'price_product' => 'required|integer|min:1',
            'quantity_product' => 'required|integer|min:1',
            'decscription' => 'required'
        ], [
            'name_product.required' => 'Tên sản phẩm không được để trống',
            'name_product.unique' => 'Tên sản phẩm đã có trong cửa hàng',
            'category_id.required' => 'Tên danh mục không được để trống',
            'price_product.min' => 'Sản phẩm không được nhỏ hơn 1',
            'quantity_product.required' => 'Số lượng sản phẩm không được để trống',
            'quantity_product.min' => 'Số lượng sản phẩm không được nhỏ hơn 1',
            'decscription.required' => 'Mô tả sản phẩm không được để trống'
        ]);
    }

    protected function insert(Request $request) {
        $this->validateInsert($request);

        $datas = [];

        $datas['name_product'] = $request->name_product;
        $datas['slug'] = Str::slug($request->name_product);
        $datas['category_id'] = $request->category_id['id'];
        $datas['price_product'] = floatval($request->price_product);
        $datas['sale'] = $request->sale || 0;
        $datas['quantity_product'] = intval($request->quantity_product);
        $datas['decscription'] = $request->decscription;
        $datas['nomination'] = $request->nomination ? 1 : 0;

        DB::beginTransaction();

        try {
            $product = Product::create($datas);

            foreach ($request->images as $image) {
                $imageLibrary = Library::findOrFail($image['id']);
                $product->images()->create([
                    'image' => $imageLibrary->image
                ]);
            }

            foreach ($request->colors as $color) {
                $product->colors()->attach($color['id']);
            }

            foreach ($request->sizes as $size) {
                $product->sizes()->attach($size['id']);
            }

            DB::commit();

            return response()->json(['status' => 200, 'message' => 'Thêm sản phẩm thành công!']);
        } catch(Exception $e) {
            DB::rollBack();
        
            throw new Exception($e->getMessage());
        }
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
