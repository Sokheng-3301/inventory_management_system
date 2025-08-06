<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\App;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function language($locale)
    {
        
    
        // dd('hi');
        if(!in_array($locale, ['en', 'kh'])){
            abort(400);
        }

        // App::setLocale($locale);
        session(['localization' => $locale]);
        
        return redirect()->back();
    }
}
