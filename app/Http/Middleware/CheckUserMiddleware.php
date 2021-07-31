<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\ChucNangUser;
use App\Models\User;
use Auth;

class CheckUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $tenRoute)
    {
        foreach(Auth::user()->chucnang as $chucnang){
            if($tenRoute == $chucnang->tenroute){
                return $next($request);
            }
        }
        return redirect()->back();
   
    }
}
