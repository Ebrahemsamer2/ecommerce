<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;

class AdminsOnly
{
    
    public function handle($request, Closure $next)
    {   
        if(auth()->check()) {
            $admin = auth()->user();
            if($admin->admin) {
                return $next($request); 
            }
        }
        return redirect()->route('home');
    }
}
