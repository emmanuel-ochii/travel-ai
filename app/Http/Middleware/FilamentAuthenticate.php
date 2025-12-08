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

        // Allow login page to be accessed freely
        if ($request->is('admin/login')) {
            return $next($request);
        }

        // If not logged in, redirect to Filament login
        if (!$user) {
            return redirect('/admin/login');
        }

        // If logged in, allow access to any /admin/* page
        return $next($request);
    }
}
