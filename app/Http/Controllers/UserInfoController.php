<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserInfoController extends Controller
{
    public function index(): View
    {
        $users = User::paginate(2);

        return view('admin.user_list')->with('users', $users);
    }
}
