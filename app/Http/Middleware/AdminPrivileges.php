<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminPrivileges
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next,$params)
    {
        list($role) = explode(':',$params);

        $user = Auth::user();

        if($user->isRole($role)){
            return $next($request);
        }else{
            return redirect()->to('admin');
        }

    }
}
