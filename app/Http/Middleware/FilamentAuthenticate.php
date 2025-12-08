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

        // Allow /admin/login page but handle logged-in non-admins
        if ($request->is('admin/login')) {
            if ($user && !$user->canAccessFilament()) {
                // Logout user to prevent further access
                Auth::logout();

                // Redirect to general login with error message
                return redirect('/login')->withErrors([
                    'email' => 'You are not authorized to access the admin panel.',
                ]);
            }
            return $next($request);
        }

        // For all other /admin/* pages

        // If not logged in, redirect to Filament login
        if (!$user) {
            return redirect('/admin/login');
        }

        // If logged in but not an admin, redirect to general login
        if (!$user->canAccessFilament()) {
            Auth::logout();
            return redirect('/login')->withErrors([
                'email' => 'You are not authorized to access the admin panel.',
            ]);
        }

        return $next($request);
    }
}
