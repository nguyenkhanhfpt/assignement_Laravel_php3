<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentController extends Controller
{
    protected function addComment(Request $request) {
        $product_id = $request->product_id;
        $content = $request->content;

        $data = ['content' => $content, 'member_id' => Auth::id(), 'product_id' => $product_id];

        Comment::create($data);

        return redirect()->back()->with('successComment', 'Thêm bình luận thành công!');
    }

    protected function deleteComment($id) {
        $comment = Comment::find($id);

        if(Auth::id() != $comment->member_id) {
            return redirect()->back()->with('errorComment', 'Bạn không thể xóa bình luận này!');
        }

        $comment->delete();
        return redirect()->back()->with('successComment', 'Xóa bình luận thành công!');
    }
}
