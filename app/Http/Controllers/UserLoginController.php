<?php

namespace App\Http\Controllers;

use \Illuminate\Contracts\View\View;


class UserLoginController extends Controller
{
    public function loginPage(): View
    {
        return view('login');
    }
}
