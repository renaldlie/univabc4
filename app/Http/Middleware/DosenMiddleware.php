<?php


namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class DosenMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 'dosen') {
            return $next($request);
        }
        return redirect('/');
    }   
}
