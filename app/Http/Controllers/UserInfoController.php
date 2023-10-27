<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\UniqueEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use \Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;

class UserInfoController extends Controller
{
    public const FILE_NAME = 'users-list';

    public function index(Request $request
    ): View|Application|Factory|JsonResponse|\Illuminate\Contracts\Foundation\Application {
        if ($request->ajax()) {
            $users = User::select('id', 'name', 'email', 'role', 'created_at')->get();

            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    $actions = '';

                    if ($user->role === 'Admin' || auth()->user()->id === $user->id) {
                        $actions .= '<a href="' . route(
                                'edit-user',
                                $user->id
                            ) . '" class="btn btn-primary btn-sm">Edit</a>';
                    }

                    return $actions;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.user_list')->with('filename', self::FILE_NAME);
    }


    public function editUser($id): View
    {
        $userInfo = User::findOrFail($id);
        return view('admin.edit_user', compact('userInfo'));
    }


    public function updateUser(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string',
        ]);

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.home')->with('error', 'Пользователь не найден');
        }

        $user->name = $request->input('name');
        $user->role = $request->input('role');


        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('user.list')->with('success', 'Пользователь успешно обновлен');
    }

    public function profileEdit(): View
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function profileUpdate(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $request->validate([
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if ($request->password) {
            if (Hash::check($request->password, $user->password)) {
                return redirect()->route('profile.edit')->with(
                    'error',
                    'Новый пароль совпадает со старым. Укажите другой пароль.'
                );
            }

            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('admin.home')->with('success', 'Профиль обновлен.');
        }

        return redirect()->route('profile.edit')->with(
            'info',
            'Профиль не был обновлен, так как новый пароль не был указан.'
        );
    }

    public function create(): View
    {
        return view('admin/create_user');
    }


    public function store(Request $request): RedirectResponse
    {
        $validationData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', new UniqueEmail, 'max:255'],
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
        ]);

        $existingUser = User::onlyTrashed()->where('email', $validationData['email'])->first();

        if ($existingUser) {
            return redirect()->route('user.deleted', $existingUser->id);
        }

        $user = User::create([
            'name' => $validationData['name'],
            'email' => $validationData['email'],
            'password' => bcrypt($validationData['password']),
            'role' => $validationData['role'],
        ]);

        return redirect()->route('user.list')->with('success', 'Пользователь удачно создан');
    }


    public function destroy($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Пользователь успешно удален.');
    }

    public function deletedUser($id): RedirectResponse|View
    {
        $user = User::onlyTrashed()->find($id);

        if ($user) {
            return view('admin.restore_user', compact('user'));
        } else {
            // Если пользователь не найден, перенаправляем на главную
            return redirect()->route('admin.home');
        }
    }

    public function restore($id): RedirectResponse
    {
        $user = User::withTrashed()->find($id);

        if ($user) {
            $user->restore();
            return redirect()->route('edit-user', ['id' => $id])->with('success', "Пользователь успешно востановлен");
        }

        return redirect()->route('admin.home');
    }
}
