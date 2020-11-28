<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Bill;
use App\Product;
use Yajra\DataTables\Facades\DataTables;

class BillController extends Controller
{
    protected function index(Request $request) {
        if ($request->ajax()) {
            $bills = Bill::with(['member', 'detail_bill'])->get();

            foreach($bills as $bill) {
                $sum = 0;
                $quantity = 0;
                foreach ($bill->detail_bill as $detail) {
                    $sum += $detail->amount;
                    $quantity += $detail->quantity_buy;
                }
                $bill->total = number_format($sum) . ' đ';
                $bill->detail_bill_count = $quantity;
            }

            return DataTables::of($bills)
                ->addColumn('status-box', function($bill) {
                    if ($bill['status'] == config('settings.rejected')) {
                        return "<span class='badge badge-pill badge-danger'>Đã hủy</span>";
                    } else if ($bill['status'] == config('settings.accepted')) {
                        return "<span class='badge badge-pill badge-success'>Đã hoàn thành</span>";
                    } else if ($bill['status'] == config('settings.running')) {
                        return "<span class='badge badge-pill badge-warning'>Đang giao</span>";
                    } else {
                        return "<span class='badge badge-pill badge-info'>Đang chờ</span>";
                    }
                })
                ->rawColumns(['status-box'])
                ->make(true);
        }

        return view('admins.bills');
    }

    protected function viewBill($id) {
        $bill = Bill::findOrFail($id)->load([
            'member',
            'code',
            'detail_bill.product.images',
            'detail_bill.color',
            'detail_bill.size',
        ]);
        $sum = 0;
        
        foreach ($bill->detail_bill as $detail) {
            $sum += $detail->amount;
        }

        $bill->total = $sum;

        return view('admins.viewBill', compact('bill'));
    }

    protected function deleteBill($id) {
        $bill = Bill::find($id);
        $bill->delete();

        return redirect()->route('adminBill');
    }

    public function update(Request $request)
    {
        $bill = Bill::findOrFail($request->id);

        $bill->status = $request->status;

        $bill->save();

        return response()->json($bill);
    }
}
