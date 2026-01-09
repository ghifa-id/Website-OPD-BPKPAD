<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $menus = Menu::orderBy('urutan')->get(); // atau Menu::menuWebsite()->get();
            $view->with('menus', $menus);
        });
    }

    public function register(): void
    {
        //
    }
}
