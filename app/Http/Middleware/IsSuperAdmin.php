<?php

namespace App\Http\Middleware;

use Closure;

class IsSuperAdmin
{
    
    public function handle($request, Closure $next)
    {	
    	$admin = auth()->user();
    	if($admin->is_super) {
        	return $next($request);
    	}
    	return redirect()->route('dashboard');
    }
}
