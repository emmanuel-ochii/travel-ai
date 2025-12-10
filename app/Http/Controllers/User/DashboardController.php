<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Total booked flights
        $totalFlights = $user->bookings()->count();

        // Most recent flights (latest 5)
        $recentFlights = $user->bookings()
            ->with(['flight', 'flight.origin', 'flight.destination'])
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact('totalFlights', 'recentFlights'));
    }

    public function bookings()
    {
        $user = Auth::user();

        // Paginated bookings
        $recentFlights = $user->bookings()
            ->with(['flight', 'flight.origin', 'flight.destination'])
            ->latest()
            ->paginate(10); // <-- change the number per page if needed

        return view('user.bookings', compact('recentFlights'));
    }

    public function reviews()
    {
        return view('user.dashboard');
    }

    public function recommendations()
    {
        return view('user.dashboard');
    }

    public function account()
    {
        return view('user.account');
    }
}
