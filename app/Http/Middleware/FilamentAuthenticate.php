<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilamentAuthenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Redirect guests to login
        if (!$user) {
            return redirect('/admin/login');
        }

        // **REMOVE role check temporarily**
        // Any authenticated user can access admin panel now

        return $next($request);
    }
}
