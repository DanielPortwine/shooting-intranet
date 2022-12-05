<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving(function () {
            Filament::registerUserMenuItems([
                'account' => UserMenuItem::make()->url(route('profile.show')),
                UserMenuItem::make()
                    ->label('Home')
                    ->url(route('dashboard'))
                    ->icon('heroicon-s-home'),
                'logout' => UserMenuItem::make()->label('Log out'),
            ]);
        });
    }
}
