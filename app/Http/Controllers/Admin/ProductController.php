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
use Yajra\DataTables\Facades\DataTables;
use App\Helper\Helper;

class ProductController extends Controller
{
    protected function index(Request $request) {
        $products = Product::all()->load('images');

        return view('admins.products', [
            'products' => $products
        ]);
    }

    protected function viewAdd() {
        return view('admins.addProduct');
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
        $datas['sale'] = $request->sale ?$request->sale : 0;
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

        DB::beginTransaction();

        try {
            $product->images()->delete();
            $product->colors()->detach();
            $product->sizes()->detach();
            $product->delete();

            DB::commit();

            return response()->json(['status' => 200, 'message' => 'Xóa sản phẩm thành công!']);
        } catch(Exception $e) {
            DB::rollBack();
        
            throw new Exception($e->getMessage());
        }
    }

    protected function viewUpdate(Request $request, $id) {
        $product = Product::with(['images', 'colors', 'sizes', 'category'])->find($id);

        if ($request->ajax()) {
            $libraries = [];
            foreach($product->images as $item) {
                if ($item->image == config('settings.default_product')) {
                    break;
                }
                $library = Library::where('image', $item->image)->first();
                array_push($libraries, $library);
            }

            $product->libraries = $libraries;

            foreach($product->libraries as $item) {
                $item->image = asset('images/products') .'/'. $item->image;
                $item->isChoosed = true;
            }

            return response()->json($product);
        }
        
        return view('admins.updateProduct', compact('product'));
    }

    protected function validateUpdate($request) {
        $request->validate([
            'name_product' => 'required',
            'category_id' => 'required',
            'price_product' => 'required|integer|min:1',
            'quantity_product' => 'required|integer|min:0',
            'decscription' => 'required'
        ], [
            'name_product.required' => 'Tên sản phẩm không được để trống',
            'category_id.required' => 'Tên danh mục không được để trống',
            'price_product.min' => 'Sản phẩm không được nhỏ hơn 1',
            'quantity_product.required' => 'Số lượng sản phẩm không được để trống',
            'quantity_product.min' => 'Số lượng sản phẩm không được nhỏ hơn 1',
            'decscription.required' => 'Mô tả sản phẩm không được để trống'
        ]);
    }

    protected function update(Request $request, $id) {
        $this->validateUpdate($request);

        $product = Product::find($id);

        DB::beginTransaction();

        try {
            $product->name_product = $request->name_product;
            $product->slug = Str::slug($request->name_product);
            $product->category_id = $request->category_id['id'];
            $product->price_product = floatval($request->price_product);
            $product->sale = $request->sale ?$request->sale : 0;
            $product->quantity_product = intval($request->quantity_product);
            $product->decscription = $request->decscription;
            $product->nomination = $request->nomination ? 1 : 0;

            $product->images()->delete();
            $product->colors()->detach();
            $product->sizes()->detach();

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

            $product->save();

            DB::commit();

            return response()->json(['status' => 200, 'message' => 'Cập nhật sản phẩm thành công!']);
        } catch(Exception $e) {
            DB::rollBack();
        
            throw new Exception($e->getMessage());
        }
    }
}
