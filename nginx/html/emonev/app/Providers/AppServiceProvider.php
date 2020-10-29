<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $varGlobal = array();
        
        if(Request::segment(1) == 'beranda'){
            $varGlobal['beranda'] = 'class="active"';
        }else if(Request::segment(1) == 'data-sp2d'){
            $varGlobal['data-sp2d'] = 'class="active"';
        }else if(Request::segment(1) == 'data-spj'){
            $varGlobal['data-spj'] = 'class="active"';
        }else if(Request::segment(1) == 'laporan'){
            $varGlobal['laporan'] = 'class="active"';
        }else if(Request::segment(1) == 'user'){
            $varGlobal['user'] = 'class="active"';
        }

        View::share('varGlobal', $varGlobal);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
