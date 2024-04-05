<?php

namespace App\Providers;

use App\Interfaces\IAuth;
use App\Interfaces\IUser;
use App\Interfaces\IUserExcelImport;
use App\Services\AuthService;
use App\Services\UserExecelImportService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this -> app -> bind(IAuth::class,AuthService::class);
        $this -> app -> bind(IUserExcelImport::class,UserExecelImportService::class);
        $this -> app -> bind(IUser::class,UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
