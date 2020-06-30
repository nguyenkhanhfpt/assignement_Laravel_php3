<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentController extends Controller
{
    protected function addComment(Request $request) {
        $id_product = $request->id_product;
        $content = $request->content;

        $data = ['content' => $content, 'id_member' => Auth::user()->id_member, 'id_product' => $id_product];

        Comment::create($data);

        return redirect()->back()->with('successComment', 'Thêm bình luận thành công!');
    }

    protected function deleteComment($id) {
        $comment = Comment::find($id);

        if(Auth::user()->id_member != $comment->id_member) {
            return redirect()->back()->with('errorComment', 'Bạn không thể xóa bình luận này!');
        }

        $comment->delete();
        return redirect()->back()->with('successComment', 'Xóa bình luận thành công!');
    }
}
