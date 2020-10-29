<?php

namespace App\Providers;

use Horizon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

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
        
        //PENGATURAN
        if(Request::segment(1) == 'beranda'){
            $varGlobal['beranda'] = 'active';
        }else if(Request::segment(1) == 'prognosis'){
            $varGlobal['prognosis'] = 'active';
        }else if(Request::segment(1) == 'konsolidasi'){
            $varGlobal['konsolidasi'] = 'active';
        }else if(Request::segment(1) == 'entry-data'){
            $varGlobal['entry-data'] = 'active';
        }else if(Request::segment(1) == 'pengaturan'){
            $varGlobal['pengaturan'] = 'active';
        }

        Horizon::auth(function ($request) {
            return true;
        });

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
