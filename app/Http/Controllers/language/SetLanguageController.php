<?php

namespace App\Http\Controllers\language;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLanguageController extends Controller
{
    public function setLanguage(Request $request,$locale)
    {
        
        $request->session()->put('locale', $locale);
        app()->setLocale($locale);
        return redirect()->back();
    }
}
