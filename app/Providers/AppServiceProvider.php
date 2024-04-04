<?php

namespace App\Providers;

use App\Interfaces\IAuth;
use App\Interfaces\IFiles;
use App\Services\AuthService;
use App\Services\FileService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this -> app -> bind(IAuth::class,AuthService::class);
        $this -> app -> bind(IFiles::class,FileService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
