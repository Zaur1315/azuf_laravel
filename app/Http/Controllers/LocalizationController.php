<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    public function setLocale($locale)
    {
        if (in_array($locale, ['az', 'ru', 'en'])) {
            App::setLocale($locale);
            session(['locale' => $locale]);
        }
        return redirect()->back();
    }
}
