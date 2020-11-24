<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper;

class HomeController extends Controller
{
    function index() {
        return view('admins.admin');
    }

    public function updateDom()
    {
        $countBill = Helper::exec()->getNumPeddingBill();

        return response()->json([
            'countBill' => $countBill
        ]);
    }
}
