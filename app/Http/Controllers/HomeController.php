<?php

namespace App\Http\Controllers;
use App\Models\Review;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $reviews = Review::with('booking.flight', 'user')->latest()->take(5)->get();

    return view('welcome', compact('reviews'));
    }
}
