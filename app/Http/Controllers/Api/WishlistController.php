<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['product_id'] = $request->product_id;
        $data['member_id'] = $request->member_id ? $request->member_id : Auth::id();

        $wishlist = Wishlist::create($data);

        if ($wishlist) {
            return response()->json([
                'status' => 200, 
                'message' => trans('view.add_wishlist_succ')
            ]);
        } else {
            return response()->json([
                'status' => 400, 
                'message' => trans('view.add_wishlist_failed')
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
