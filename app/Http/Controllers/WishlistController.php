<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use App\Wishlist;

class WishlistController extends Controller
{
    protected function index() {
        $wishlists = [];

        if (Auth::user()) {
            $member = Auth::user();
            $wishlists = $member->wishlists->load(['product.images']);
        }

        return view('wishlist', compact('wishlists'));
    }

    protected function addWish(Request $request) {
        if (!Auth::user()) {
            return response()->json([
                'status' => 400, 
                'message' => trans('view.add_wishlist_auth')
            ]);
        }

        $data['product_id'] = $request->product_id;
        $data['member_id'] = $request->member_id ? $request->member_id : Auth::id();

        $checkWishlist = Wishlist::where('member_id', $data['member_id'])
            ->where('product_id', $data['product_id'])->first();

        if ($checkWishlist) {
            return response()->json([
                'status' => 400, 
                'message' => trans('view.add_wishlist_existed')
            ]);
        }

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

    protected function deleteWish(Wishlist $wishlist) {
        $this->authorize('delete', $wishlist);

        $wishlist->delete();

        return redirect()->back();
    }

    protected function match_price($price, $sale) {
        $result = $price - ($price / 100 * $sale);
        return $result;
    }

}
