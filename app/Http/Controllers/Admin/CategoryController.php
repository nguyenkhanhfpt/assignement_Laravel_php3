<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    protected function index() {
        $datas = Category::all();

        return view('admins.category', [
            'categories' => $datas
        ]);
    }

    protected function viewAdd() {
        return view('admins.addCategory');
    }

    protected function addCategory(Request $request) {
        $request->validate([
            'name' => 'required',
            'img_category' => 'required'
        ], [
            'name.required' => 'Tên danh mục không được để trống!',
            'img_category.required' => 'Ảnh danh mục không để trống!'
        ]);

        
        $name = $request->input('name');
        $file = $request->img_category;
        $img_category = $file->getClientOriginalName();

        $file->move('images', $img_category);

        $data = ['name' => $name, 'img_category' => $img_category];

        Category::create($data);

        return view('admins.addCategory', [
            'success' => 'Thêm danh mục mới thành công!'
        ]);
    }

    protected function deleteCategory($id_category) {
        Category::find($id_category)->delete();
        return redirect(route('adminCategory'));
    }

    protected function viewUpdate($id_category) {
        $category = Category::find($id_category);

        return view('admins.updateCategory', [
            'id_category' => $category->id_category,
            'name' => $category->name,
            'img_category' => $category->img_category,
        ]); 
    }

    protected function updateCategory(Request $request, $id_category) {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Tên danh mục không được để trống!'
        ]);

        $name = $request->input('name');
        $category = Category::find($id_category);

        if($request->hasFile('img_category')) {
            $file = $request->img_category;
            $img_category = $file->getClientOriginalName();
            $file->move('images', $img_category);

            $category->name = $name;
            $category->img_category = $img_category;
            $category->save();
        }
        else {
            $category->name = $name;
            $category->save();
        }

        return view('admins.updateCategory', [
            'id_category' => $category->id_category,
            'name' => $category->name,
            'img_category' => $category->img_category,
            'success' => 'Cập nhật danh mục thành công!'
        ]);
    }
}
