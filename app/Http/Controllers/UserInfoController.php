<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class UserInfoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select('id', 'name', 'email', 'role', 'created_at')->get();

            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    $actions = '';

                    // Проверка на администратора и текущего пользователя
                    if ($user->role === 'Admin' || auth()->user()->id === $user->id) {
                        $actions .= '<a href="' . route('edit-user', $user->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                    }

                    // Удалять пользователя не будем, так как это опасное действие

                    return $actions;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.user_list');
    }
}
