<?php

namespace App\Providers;


use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

use App\Models\Advertisement;
use App\Models\League;
use App\Models\ReferenceAdvertisement;
use App\Models\Store;
use App\Models\Tournament;
use App\Models\TournamentTypeAdvertisement;
use App\Models\TypeAdvertisement;

use DateTime;

use function App\Models\league;

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

//        View::share('leagues', League::all());
        if (Schema::hasTable('store_user'))
        {

            View::composer('frontend.*', function ($view) {

                $storeSlug = Request::route('store_slug');
                $store = Store::where('slug',$storeSlug)->first();

                $view->with('storeSlug', $storeSlug);
                $view->with('store', $store);

            });


        }

    }
}
