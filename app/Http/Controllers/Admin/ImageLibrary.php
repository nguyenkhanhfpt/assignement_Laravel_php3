<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library;

class ImageLibrary extends Controller
{
    public function index()
    {
        $libraries = Library::orderBy('created_at', 'DESC')->get();

        foreach($libraries as $item) {
            $item->image = asset('images/products') .'/'. $item->image;
            $item->isChoosed = false;
        }

        return response()->json($libraries);
    }

    public function store(Request $request)
    {
        $file = $request->file;
        $img = strtotime("now"). $file->getClientOriginalName();
        $file->move('images/products', $img);

        $library = Library::create(['image' => $img]);

        $library->image = asset('images/products') .'/'. $library->image;
        $library->isChoosed = false;

        if ($library) {
            return response()->json(['status' => 200, 'data' => $library]);
        } else {
            return response()->json(['status' => 400]);
        }
    }
}
