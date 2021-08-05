<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\ChucNangUser;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class CheckUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->checkauth($request->route()->getName())) {
            return $next($request);
        }

        return redirect()->back();
    }
}
