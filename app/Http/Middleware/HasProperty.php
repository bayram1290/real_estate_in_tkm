<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class HasProperty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
	    if (Session::has('lang')){
		    App::setLocale(session('lang'));
		    $lang = session('lang');
	    }
	    else{
		    App::setLocale('ru');
		    $lang = 'ru';
	    }

    	if (Auth::user()->hasProperty()){
    		Session::flash('fail',__('messages.has_property'));
    		return redirect()->back();
	    }

        return $next($request);
    }
}
