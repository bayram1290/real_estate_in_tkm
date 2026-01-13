<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserProperty
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

    	foreach (Auth::user()->properties as $property){
    		if ($property->id === (int)$request->id){
			    return $next($request);
		    }
	    }
        return redirect()->back();
    }
}
