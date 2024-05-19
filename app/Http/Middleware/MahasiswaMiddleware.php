<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MahasiswaMiddleware
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
        // Check if the authenticated user has the role of "mahasiswa"
        if ($request->user() && $request->user()->role === 'mahasiswa') {
            return $next($request);
        }

        // Redirect to another route if the user is not a mahasiswa
        return redirect('/');
    }
}
