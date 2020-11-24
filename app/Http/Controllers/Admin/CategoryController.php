<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    protected function index(Request $request) {
        if ($request->ajax()) {
            $datas = Category::all();

            return DataTables::of($datas)->make(true);
        }

        return view('admins.category');
    }

    protected function addCategory(Request $request) {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Tên danh mục không được để trống!',
        ]);
        
        $name = $request->name;

        $category = Category::create(['name' => $name]);

        if ($category) {
            return response()->json([
                'status' => 200, 
                'message' => 'Thêm mới thành công!'
            ]);
        } else {
            return response()->json([
                'status' => 400, 
                'message' => 'Thêm mới thất bại!'
            ]);
        }
    }

    protected function deleteCategory($id_category) {
        $category = Category::findOrFail($id_category);

        $result = $category->delete();

        if ($result) {
            return response()->json([
                'status' => 200, 
                'message' => 'Xóa thành công!'
            ]);
        } else {
            return response()->json([
                'status' => 400, 
                'message' => 'Xóa thất bại!'
            ]);
        }
    }

    protected function edit($id_category) {
        $category = Category::findOrFail($id_category);

        return response()->json($category);
    }

    protected function updateCategory(Request $request, $id_category) {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Tên danh mục không được để trống!'
        ]);

        $category = Category::findOrFail($id_category);

        $category->name = $request->name;
        $result = $category->save();

        if ($result) {
            return response()->json([
                'status' => 200, 
                'message' => 'Cập nhật thành công!'
            ]);
        } else {
            return response()->json([
                'status' => 400, 
                'message' => 'Cập nhật thất bại!'
            ]);
        }
    }
}
