<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function changeLanguage()
    {
        session()->get('locale') ? App::setLocale(session()->get('locale')) : 'en';
    }
}
