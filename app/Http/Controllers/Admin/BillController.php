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
                    if ($bill['status'] == 2) {
                        return "<span class='badge badge-pill badge-danger'>Đã hủy</span>";
                    } else if ($bill['status'] == 1) {
                        return "<span class='badge badge-pill badge-success'>Đã chấp nhận</span>";
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
            'detail_bill.product.images',
            'detail_bill.color',
            'detail_bill.size',
        ]);
        $sum = 0;
        
        foreach ($bill->detail_bill as $detail) {
            $sum += $detail->amount;
        }

        $bill->total = $sum;
        //return $bill;

        return view('admins.viewBill', compact('bill'));
    }

    protected function updateBill(Request $request) {
        $id_bill = $request->id_bill;
        $status = $request->status ? $request->status : 0;

        $bill = Bill::find($id_bill);
        $bill->status = $status;
        $bill->save();

        // Nếu đơn hàng được hoàn thành thì trừ số lượng của sản phẩm
        if($status == 1) {
            $bills = Bill::find($id_bill)->detail_bill;

            foreach ($bills as $pro) {
                $product = Product::find($pro->id_product);
                $product->quantity_product -= $pro->quantity_buy;
                $product->save();
            }
        }

        return redirect()->back()->with('successBill', 'Cập nhật đơn hàng thành công!');
    }

    protected function deleteBill($id) {
        $bill = Bill::find($id);
        $bill->delete();

        return redirect()->route('adminBill');
    }
}
