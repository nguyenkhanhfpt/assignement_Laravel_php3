<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function index() {
        $user = Auth::user();

        $bills = []; 

        return view('account', compact(['bills', 'user']));
    }

    protected function updateProfile(Request $request) {
        $request->validate([
            'name_member' => 'required'
        ]);
        
        //dd(Auth::id());
        $member = User::find(Auth::id());

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
