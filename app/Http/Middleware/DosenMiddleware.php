<?php


namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class DosenMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'dosen') {
            return $next($request);
        }

        return redirect('/'); // or any other logic
    }
}
