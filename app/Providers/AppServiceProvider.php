<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\siteSetting;
use Illuminate\Support\Facades\Cookie;

class AppServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    Schema::defaultStringLength( 191 );
	    View::share( 'settings', siteSetting::first() );

	    view()->composer('*', function($view) {
		    if ( Auth::check() ) {
			    View::share( 'fav_num', Auth::user()->favorite_properties->count() );
		    } else {
			    $favorite = Cookie::get( 'favorite' );
			    if ( ! empty( $favorite ) ) {
				    $arr     = explode( ',', $favorite);
				    $fav_num = count( $arr );
			    } else {
				    $fav_num = 0;
			    }
			    if ( isset( $arr ) ) {
				    View::share( 'arr_cookie', $arr );
			    }
			    View::share( 'fav_num', $fav_num );
		    }
	    });
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
