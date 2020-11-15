<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Color;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all('id', 'name');

        return response()->json($colors);
    }
}
