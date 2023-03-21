<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        session()->put('locale', $lang);
        return back();
    }
}