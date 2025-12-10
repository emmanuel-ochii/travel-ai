<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Flight;
use App\Models\UserInteraction;
use App\Services\InteractionLogger;
use Illuminate\Support\Facades\Auth;
use App\Services\TravelRecommendationService;

class RecommendationController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user)
            abort(403);

        $useLlm = $request->boolean('use_llm', false);

        $service = new TravelRecommendationService($user);
        $recommendedFlights = $service->getRecommendations(5, $useLlm);

        return view('recommendations.index', compact('recommendedFlights'));
    }


    public function feedback(Request $req, Flight $flight)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $req->validate([
            'liked' => 'required|boolean'
        ]);

        // Check if user already voted
        $existing = UserInteraction::where('user_id', $user->id)
            ->where('type', 'feedback')
            ->where('payload->flight_id', $flight->id)
            ->first();

        if ($existing) {
            return response()->json(['message' => 'Already voted'], 409);
        }

        InteractionLogger::log('feedback', [
            'flight_id' => $flight->id,
            'liked' => (bool) $req->liked,
        ]);

        return response()->json(['ok' => true]);
    }
}
