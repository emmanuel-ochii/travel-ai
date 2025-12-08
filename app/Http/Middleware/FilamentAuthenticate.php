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

        // Allow the Filament login page to be accessed freely
        if ($request->is('admin/login')) {
            return $next($request);
        }

        // If not logged in, redirect to Filament login
        if (!$user) {
            return redirect('/admin/login');
        }

        // If logged in but not an admin, redirect to normal login page
        if (!$user->hasRole('admin')) {
            return redirect('/login')->withErrors([
                'email' => 'You are not authorized to access the admin panel.',
            ]);
        }

        // If logged in and is admin, allow access
        return $next($request);
    }
}
