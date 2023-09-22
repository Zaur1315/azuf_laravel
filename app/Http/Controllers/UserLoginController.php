<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Contracts\View\View;
use \Illuminate\Foundation\Application;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application as Application_Foundation;

class UserLoginController extends Controller
{
    public function loginPage(): View|Application|Factory|Application_Foundation
    {
        return view('login');
    }
}
