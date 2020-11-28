<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Code;
use App\Category;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class CodeController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $datas = Code::all();

            return DataTables::of($datas)
                ->addColumn('sale', function($data) {
                    $sale = number_format($data->price);

                    return "$sale đ";
                })
                ->addColumn('status', function($data) {
                    $now = Carbon::now('Asia/Ho_Chi_Minh');
                    $start = $data->start; 
                    $end = $data->end; 

                    if ($now < $start) {
                        return "<span class='badge badge-pill badge-info'>Đang chờ</span>";
                    } else if ($now > $start && $now < $end) {
                        return "<span class='badge badge-pill badge-success'>Đang hoạt động</span>";
                    } else {
                        return "<span class='badge badge-pill badge-danger'>Đã kết thúc</span>";
                    }
                })
                ->rawColumns(['sale', 'status'])
                ->make(true);
        }

        return view('admins.code');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:codes',
            'price' => 'required|integer|min:1',
            'start' => 'required',
            'end' => 'required'
        ]);

        $code = Code::create($request->all());

        if ($code) {
            return response()->json([
                'status' => 200, 
                'message' => 'Thêm mới mã giảm giá thành công!'
            ]);
        } else {
            return response()->json([
                'status' => 400, 
                'message' => 'Thêm mới mã giảm giá thất bại!'
            ]);
        }
    }

    public function destroy($id)
    {
        $code = Code::findOrFail($id);

        $result = $code->delete();

        if ($result) {
            return response()->json([
                'status' => 200, 
                'message' => 'Xóa mã giảm giá thành công!'
            ]);
        } else {
            return response()->json([
                'status' => 400, 
                'message' => 'Xóa mã giảm giá thất bại!'
            ]);
        }
    }
}
