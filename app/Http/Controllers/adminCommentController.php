<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Comment;

class adminCommentController extends Controller
{
    protected function index(){
        $comments = DB::table('comments as C')
            ->join('members as M', 'C.id_member', '=', 'M.id_member')
            ->join('products as P', 'C.id_product', '=', 'P.id_product')
            ->select('C.id_comment', 'C.content', 'C.id_member', 'C.date_comment', 'M.name_member', 'M.img_member', 
            'name_product', 'P.img_product')
            ->orderBy('C.date_comment', 'DESC')
            ->get();

        return view('admins.comments', compact(['comments']));
    }

    protected function deleteComment($id) {
        Comment::find($id)->delete();

        return redirect()->route('adminComment');
    }
}
