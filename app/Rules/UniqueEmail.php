<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueEmail implements Rule
{
    public function __construct()
    {
        //
    }
    public function passes($attribute, $value)
    {
        // TODO: Implement passes() method.
        // Проверяем уникальность email, игнорируя удаленных пользователей
        return DB::table('users')
                ->where('email', $value)
                ->whereNull('deleted_at')
                ->count() === 0;
    }

    public function message()
    {
        return 'Пользователь с таким email уже существует.';
    }
}
