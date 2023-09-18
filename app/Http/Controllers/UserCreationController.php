<?php

namespace App\Http\Controllers;

use \App\Http\Controllers\Controller;
use App\Models\User;
use \App\Providers\RouteServiceProvider;
use \Illuminate\Foundation\Auth\RegistersUsers;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Validator;
use \Illuminate\Validation\Validator as Validator_2;
use \Illuminate\Contracts\View\View;
use \Illuminate\Foundation\Application;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application as Contracts_Application;

class UserCreationController extends Controller
{
    public function create(): View
    {
        return view('admin/create_user');
    }


    public function store(Request $request)
    {
        $validationData = $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|email|unique:users|max:255',
           'password' => 'required|string|min:8|confirmed',
           'role' => 'required|string',
        ]);

        $user = User::create([
           'name'=>$validationData['name'],
           'email'=>$validationData['email'],
           'password'=>bcrypt($validationData['password']),
           'role' => $validationData['role'],
        ]);

        return redirect()->route('user.create')->with('success', 'Пользователь удачно создан');
    }
}
