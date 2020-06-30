<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Member;
use DB;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function index() {
        $user = Auth::user();

        $bills = DB::table('bills as B')
                    ->join('detail_bills as D', 'B.id_bill', '=', 'D.id_bill')
                    ->join('products as P', 'P.id_product', '=', 'D.id_product')
                    ->where('B.id_member', '=', Auth::user()->id_member)
                    ->orderBy('B.date_buy', 'DESC')
                    ->get(); 

        return view('account', compact('bills'),[
            'user' => $user
        ]);
    }

    protected function updateProfile(Request $request) {
        $request->validate([
            'name_member' => 'required',
            'phone_number' => 'required',
            'address' => 'required'
        ]);

        $member = Member::find(Auth::user()->id_member);

        $member->name_member = $request->name_member;
        $member->phone_number = $request->phone_number;
        $member->address = $request->address;

        if($request->hasFile('img_member')) {
            $file = $request->img_member;
            $nameImg = $file->getClientOriginalName();
            $file->move('images', $nameImg);
            $member->img_member = $nameImg;
        }

        $member->save();

        return redirect()->back()->with('successUpdate', 'Cập nhật thành công!');
    }

    protected function updatePassword(Request $request) {
        $request->validate([
            'password' => 'required|string|min:8|confirmed'
        ]);

        $oldPass = $request->oldPass;
        $newPass = Hash::make($request->password);
        $member = Member::find(Auth::user()->id_member);

        if(Auth::attempt(['id_member' => Auth::user()->id_member, 'password' => $oldPass])) {
            $member->password = $newPass;
            $member->save();

            return redirect()->back()->with('successUpdatePass', 'Cập nhật mật khẩu thành công!');
        }
        else {
            return redirect()->back()->with('errUpdatePass', 'Mật khẩu của bạn không chính xác!');
        }
    }
}
