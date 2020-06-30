<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use DB;

class adminProductController extends Controller
{
    protected function index() {
        $products = Product::all();

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

        $file->move('images', $img_product);
        $file2->move('images', $img_product_2);
        $file3->move('images', $img_product_3);

        $datas = [];
        
        $id = $this->vn_to_eng($request->name_product);

        $datas['id_product'] = $id;
        $datas['name_product'] = $request->name_product;
        $datas['id_category'] = $request->id_category;
        $datas['price_product'] = floatval($request->price_product);
        $datas['img_product'] = $img_product;
        $datas['sale'] = $request->sale || 0;
        $datas['view'] = 0;
        $datas['quantity_product'] = intval($request->quantity_product);
        $datas['img_product_2'] = $img_product_2;
        $datas['img_product_3'] = $img_product_3;
        $datas['decscription'] = $request->decscription;
        $datas['nomination'] = $request->nomination ? 1 : 0;

        Product::create($datas);

        return redirect(route('adminProduct'));
    }

    protected function delete($id) {
        Product::find($id)->delete();

        return redirect(route('adminProduct'));
    }

    protected function viewUpdate($id) {
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


    public function vn_to_eng($str) {
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',            
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',           
            'i'=>'í|ì|ỉ|ĩ|ị',           
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',           
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',          
            'y'=>'ý|ỳ|ỷ|ỹ|y',          
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',           
            'D'=>'Đ',        
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',      
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',     
        );
             
        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ','_',$str); 
        return $str;
    }
}
