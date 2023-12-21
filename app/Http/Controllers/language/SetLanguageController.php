<?php

namespace App\Http\Controllers\language;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SetLanguageController extends Controller
{
    public function setLanguage(Request $request,$locale)
    {
        
        $request->session()->put('locale', $locale);
        app()->setLocale($locale);
        return redirect()->back();
    }
}
