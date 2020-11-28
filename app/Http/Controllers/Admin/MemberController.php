<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use DB;

class MemberController extends Controller
{
    protected function index(Request $request) {
        if($request->ajax()) {
            $members = User::where('email', '!=', 'admin@gmail.com')->get();

            return DataTables($members)
                ->addColumn('info', function($member) {
                    $img = asset('images') .'/'. $member->img_member;
                    return "
                        <span class='round'>
                            <img src=$img width='50' height='50' alt=''>
                        </span>
                        <span class='ml-1'>$member->name_member</span>
                    ";
                })
                ->addColumn('status', function($member) {
                    $id = $member->id;

                    if ($member->status_member) {
                        return "<input class='checkbox-member switch' type='checkbox' checked data-id=$id>";
                    } else {
                        return "<input class='checkbox-member switch' type='checkbox' data-id=$id>";
                    }
                })
                ->rawColumns(['info', 'status'])
                ->make(true);
        }

        return view('admins.members');
    }

    protected function updateStatus(Request $request, User $member) {
        $status = $request->status;
        $member->status_member = $status;
        $result = $member->save();

        if ($result) {
            return response()->json([
                'status' => 200, 
                'message' => 'Cập nhật trạng thái người dùng thành công!'
            ]);
        } else {
            return response()->json([
                'status' => 400, 
                'message' => 'Cập nhật trạng thái người dùng thất bại!'
            ]);
        }
    }

    protected function viewMember(User $member) {
        $member = $member->load(['bills.bill', 'bills.product', 'bills.size', 'bills.color', 'bill']);
        
        $total = 0;
        foreach($member->bills as $bill) {
            $total += $bill->amount;
        }

        $member->total = $total;

        return view('admins.viewMember', compact('member'));
    }

    function deleteMember(User $member) {
        $result = $member->delete();

        if ($result) {
            return response()->json([
                'status' => 200, 
                'message' => 'Cập nhật trạng thái người dùng thành công!'
            ]);
        } else {
            return response()->json([
                'status' => 400, 
                'message' => 'Cập nhật trạng thái người dùng thất bại!'
            ]);
        }
    }
}
