<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\Facades\DataTables;
use App\Color;
use App\Product;
use App\Comment;

class CommentController extends Controller
{
    protected function index(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::withCount(['comments'])
                ->get()
                ->where('comments_count', '>', 0);

            return DataTables::of($product)->make(true);
        }

        return view('admins.comments');
    }

    public function show(Product $product)
    {
        $commentProduct = $product->load('comments.member')->comments;
        
        return view('admins.viewComments', compact('commentProduct'));
    }

    protected function deleteComment($id)
    {
        $result = Comment::findOrFail($id)->delete();

        if ($result) {
            return response()->json([
                'status' => 200,
                'message' => 'Xóa bình luận thành công!'
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Xóa bình luận thất bại!'
            ]);
        }
    }
}
