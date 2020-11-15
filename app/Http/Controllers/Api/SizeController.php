<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Size;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::all('id', 'size');

        return response()->json($sizes);
    }
}
