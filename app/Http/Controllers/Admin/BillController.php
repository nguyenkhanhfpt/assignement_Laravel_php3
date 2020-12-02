<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Bill;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ChangeOrderNotify;
use Pusher\Pusher;
use Exception;

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
        $bill = Bill::findOrFail($request->id)->load('detail_bill.product');

        DB::beginTransaction();

        try {
            if ($request->status != config('settings.pedding')) {
                $member = User::findOrFail($bill->member_id);

                $data = [
                    'member_id' => Auth::id(),
                    'bill_id' => $bill->id,
                    'type' => $request->status
                ];
        
                Notification::send($member, new ChangeOrderNotify($data));

                $this->realtimeNotification();

                if ($request->status == config('settings.running')) {
                    foreach ($bill->detail_bill as $detail) {
                        if ($detail->product->quantity_product < $detail->quantity_buy) {
                            abort(500);
                        }
                        $detail->product->quantity_product -= $detail->quantity_buy;
                        $detail->product->save();
                    }
                }

                if ($request->status == config('settings.rejected') && $bill->status == config('settings.running')) {
                    foreach ($bill->detail_bill as $detail) {
                        $detail->product->quantity_product += $detail->quantity_buy;
                        $detail->product->save();
                    }
                }
            }
            $bill->status = $request->status;
            $bill->save();

            DB::commit();

            return response()->json($bill);
        } catch (Exception $e) {
            DB::rollBack();

            abort(500);
        }
    }

    public function realtimeNotification()
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
          );
          $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
          );
        
        $data['message'] = 'hello world';
        $pusher->trigger('notification-channel', 'notification-event', $data);
    }
}
