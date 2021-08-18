<?php

namespace App\Providers;

use App\Models\chungloai;
use App\Models\sanpham;
use App\Models\thuonghieu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        view()->share('data_chungloai', chungloai::orderBy('ten', 'asc')->get());
        view()->share('data_thuonghieu', thuonghieu::orderBy('ten', 'asc')->get());
        view()->share('data_sanpham', sanpham::orderBy('ten', 'asc')->get());
        
    }
}
