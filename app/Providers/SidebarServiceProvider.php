<?php

namespace App\Providers;

use App\Models\PaymentPage;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
//use Illuminate\View\View;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('admin.partials.sidebar', function ($view){
            $users = User::all();
            $pages = PaymentPage::all();
            $view->with([
                'users'=>$users,
                'pages'=>$pages,
            ]);
        });
    }
}
