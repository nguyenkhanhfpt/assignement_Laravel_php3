<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\User;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(5);

        return view('news', compact('news'));
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        $newsElse = News::get()->take(6);
        $member = User::admin()->first();

        return view('viewNews', compact(['news', 'member', 'newsElse']));
    }
}
