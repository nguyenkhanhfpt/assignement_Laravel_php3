<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Bill;
use App\Product;

class adminBillController extends Controller
{
    protected function index(Request $request) {
        if($request->orderBy) {
            $status = $request->orderBy;
            if($status == 'cancelled') {
                $status = -1;
            }
            else if($status == 'completed') {
                $status = 1;
            }
            else if($status == 'pedding') {
                $status = 0;
            }
            else {
                $status = " ";
            }

            $bills = DB::table('bills as B')
                ->join('detail_bills as D', 'B.id_bill', '=', 'D.id_bill')
                ->join('members as M', 'B.id_member', '=', 'M.id_member')
                ->select('M.name_member', 'M.img_member', 'B.id_bill', 'B.date_buy', 
                    'B.status', DB::raw('count(D.id_detail_bill) as totalPro'), 
                    DB::raw('sum(D.amount) as amount'))
                ->where('B.status', '=', $status)
                ->groupBy('B.id_bill')
                ->orderBy('B.date_buy', 'DESC')
                ->get(); 
        }
        else if($request->find) {
            $id = $request->find;

            $bills = DB::table('bills as B')
                ->join('detail_bills as D', 'B.id_bill', '=', 'D.id_bill')
                ->join('members as M', 'B.id_member', '=', 'M.id_member')
                ->select('M.name_member', 'M.img_member', 'B.id_bill', 'B.date_buy', 
                    'B.status', DB::raw('count(D.id_detail_bill) as totalPro'), 
                    DB::raw('sum(D.amount) as amount'))
                ->where('B.id_bill', 'LIKE',"\\" . $id . "%")
                ->groupBy('B.id_bill')
                ->orderBy('B.date_buy', 'DESC')
                ->get(); 
        }
        else {
            $bills = DB::table('bills as B')
                ->join('detail_bills as D', 'B.id_bill', '=', 'D.id_bill')
                ->join('members as M', 'B.id_member', '=', 'M.id_member')
                ->select('M.name_member', 'M.img_member', 'B.id_bill', 'B.date_buy', 
                    'B.status', DB::raw('count(D.id_detail_bill) as totalPro'), 
                    DB::raw('sum(D.amount) as amount'))
                ->groupBy('B.id_bill')
                ->orderBy('B.date_buy', 'DESC')
                ->get(); 
        }

        return view('admins.bills', [
            'bills' => $bills
        ]);
    }

    protected function viewBill($id) {
        $bill = Bill::find($id);

        if($bill == null) {
            return redirect()->route('adminBill');
        }

        $info = DB::table('bills as B')
            ->join('members as M', 'B.id_member', '=', 'M.id_member')
            ->select('M.name_member', 'M.img_member', 'B.id_bill', 'B.date_buy', 'M.address',
                'M.phone_number', 'M.email', 'B.status')
            ->where('B.id_bill', '=', $id)
            ->groupBy('B.id_bill')
            ->first();

        $productsBuy = DB::table('products as P')
            ->join('detail_bills as D', 'D.id_product', '=', 'P.id_product')
            ->where('D.id_bill', '=', $id)
            ->get();

        $sumAmount = DB::table('detail_bills')
            ->select(DB::raw('sum(amount) as total'))
            ->where('id_bill', '=', $id)
            ->groupBy('id_bill')
            ->first();


        return view('admins.viewBill', [
            'info' => $info,
            'productsBuy' => $productsBuy,
            'sumAmount' => $sumAmount
        ]);
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
