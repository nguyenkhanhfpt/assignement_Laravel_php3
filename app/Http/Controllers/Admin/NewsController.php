<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\News;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $news = News::all();

            return DataTables::of($news)
                ->addColumn('image-news', function($new) {
                    $img = asset('images') .'/'. $new->image;
                    return "
                        <img src=$img class='news-image' alt=''>";
                })
                ->rawColumns(['image-news'])
                ->make(true);
        }

        return view('admins.news');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.createNews');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:news|max:255',
            'content' => 'required',
            'description' => 'required',
            'file' => 'required'
        ]);

        $file = $request->file;
        $image = $file->getClientOriginalName();
        $file->move('images', $image);
        $slug = Str::slug($request->title);

        $request->merge(['slug' => $slug, 'image' => $image]);

        $result = News::create($request->all());

        if ($result) {
            return redirect()->route('news.index')->with('success', 'Cập nhật bài viết thành công!');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::findOrFail($id);

        return view('admins.viewNews', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);

        return view('admins.editNews', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'description' => 'required'
        ]);

        $news = News::findOrFail($id);

        $news->title = $request->title;
        $news->content = $request->content;
        $news->slug = Str::slug($request->title);
        $news->description = $request->description;

        if ($request->file) {
            $file = $request->file;
            $image = $file->getClientOriginalName();
            $file->move('images', $image);

            $news->image = $image;
        }

        $news->save();

        return redirect()->back()->with('success', 'Cập nhật bài viết thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);

        $result = $news->delete();

        if ($result) {
            return response()->json([
                'status' => 200,
                'message' => 'Xóa bài viết thành công!',
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Xóa bài viết thất bại!',
            ]);
        }
    }
}
