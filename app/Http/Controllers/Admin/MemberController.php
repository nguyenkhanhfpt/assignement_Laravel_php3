<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use DB;

class MemberController extends Controller
{
    protected function index() {
        $members = Member::all();

        return view('admins.members', compact(['members']));
    }

    protected function updateStatus0($id) {
        $member = Member::find($id);

        $member->status_member = 0;
        $member->save();
    }

    protected function updateStatus1($id) {
        $member = Member::find($id);

        $member->status_member = 1;
        $member->save();
    }

    protected function viewMember($id) {
        $bills = DB::table('bills as B')
                    ->join('detail_bills as D', 'B.id_bill', '=', 'D.id_bill')
                    ->join('products as P', 'P.id_product', '=', 'D.id_product')
                    ->where('B.id_member', '=', $id)
                    ->orderBy('B.date_buy', 'DESC')
                    ->get(); 

        $member = Member::find($id);

        return view('admins.detailMember', compact('bills'), [
            'member' => $member
        ]);
    }

    function deleteMember($id) {
        Member::find($id)->delete();

        return redirect()->back();
    }
}
