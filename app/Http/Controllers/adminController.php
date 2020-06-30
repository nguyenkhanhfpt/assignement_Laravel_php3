<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class adminController extends Controller
{
    function index() {
        return view('admins.admin');
    }
}
