<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class checkStatus
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
        if(Auth::check() && Auth::user()->status_member == 0){
            Auth::logout();
            session()->flash('err', 'Your Account is not activated yet.');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
