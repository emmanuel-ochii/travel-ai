<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Total booked flights
        $totalFlights = $user->bookings()->count();

        // Total reviews made by the user
        $totalReviews = $user->reviews()->count(); // assuming User has a reviews() relationship

        // Most recent flights (latest 5)
        $recentFlights = $user->bookings()
            ->with(['flight', 'flight.origin', 'flight.destination'])
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact('totalFlights', 'recentFlights', 'totalReviews'));
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

    public function recommendations()
    {
        return view('user.dashboard');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function reviews()
    {
        $bookings = auth()->user()
            ->bookings()
            ->with(['flight', 'flight.origin', 'flight.destination', 'review'])
            ->get();

        return view('user.reviews', compact('bookings'));
    }

    public function addReview($bookingId)
    {
        $booking = Booking::where('id', $bookingId)
            ->where('user_id', auth()->id())
            ->where('status', 'confirmed')
            ->firstOrFail();

        return view('user.post-review', compact('booking'));
    }

    public function viewReview(Review $review)
{
    abort_if($review->user_id !== Auth::id(), 403);

    // Eager load booking and flight
    $review->load('booking.flight');

    return view('user.view-review', compact('review'));
}

    public function wishlist()
    {
        return view('user.wishlist');
    }
}
