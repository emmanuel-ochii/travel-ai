<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Flight;
use App\Services\InteractionLogger;
use Illuminate\Support\Facades\Auth;
use App\Services\TravelRecommendationService;

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

    public function feedback(Request $req, Flight $flight)
    {
        $req->validate(['liked' => 'required|boolean']);
        InteractionLogger::log('feedback', [
            'flight_id' => $flight->id,
            'liked' => (bool) $req->liked,
            'note' => $req->note ?? null,
        ]);
        return response()->json(['ok' => true]);
    }

}
