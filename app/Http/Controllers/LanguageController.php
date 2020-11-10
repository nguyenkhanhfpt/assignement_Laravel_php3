<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;

class LanguageController extends Controller
{
    public function changeLanguage($locale)
    {
        if (! in_array($locale, ['en', 'vi'])) {
            abort(404);
        }

        Session::put('locale', $locale);

        return redirect()->back();
    }
}
