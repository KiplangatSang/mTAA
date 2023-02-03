<?php

namespace App\Providers;

use App\Http\Composers\AppComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\STR;
use App\Http\Composers\LandlordComposer;

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
        //
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        Str::macro('partnumber', function ($part) {
            return 'AB-' . substr($part, 0, 3) . '_' . substr($part, 3);
        });
        Schema::defaultStringLength(191);


        View::composer(['*',], AppComposer::class);
        View::composer(['landlord.*',], LandlordComposer::class);
        // View::composer(['supplier.*',], AdminAppComposer::class);
    }
}
