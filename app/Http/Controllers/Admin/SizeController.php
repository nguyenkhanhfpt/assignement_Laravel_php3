<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Size;

class SizeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sizes = Size::get();
        
            return DataTables::of($sizes)->make(true);
        }

        return view('admins.size');
    }

    public function store(Request $request)
    {
        $request->validate([
            'size' => 'required|max:250|unique:sizes'
        ]);

        $size = Size::create($request->all());

        if ($size) {
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

    public function edit($id)
    {
        $size = Size::findOrFail($id);

        return $size;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'size' => 'required|max:250'
        ]);

        $size = Size::findOrFail($id);

        $size->size = $request->size;
        $result = $size->save();

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::findOrFail($id);

        $size->products()->detach();

        $result = $size->delete();

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
}
