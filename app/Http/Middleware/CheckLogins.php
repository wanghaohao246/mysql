<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogins
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
        //执行操作
        $user = session('admins');
        // dd($user);
        if(!$user){
            return redirect('/logins');
        }
        return $next($request);
    }
}
