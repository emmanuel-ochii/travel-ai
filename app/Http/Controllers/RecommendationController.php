<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\TravelRecommendationService;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'You must be logged in to view recommendations.');
        }

        $service = new TravelRecommendationService($user);
        $recommendedFlights = $service->getRecommendations(5);

        return view('recommendations.index', compact('recommendedFlights'));
    }
}
