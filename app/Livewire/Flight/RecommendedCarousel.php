<?php

namespace App\Livewire\Flight;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Services\TravelRecommendationService;
use Illuminate\Support\Facades\Cache;

class RecommendedCarousel extends Component
{
    public $recommendations = [];
    public $loading = true;

    public function mount()
    {
        $user = Auth::user();
        if (!$user) {
            $this->loading = false;
            return;
        }

        // Cache key: prevent repeated LLM calls
        $cacheKey = "user_recommendations_{$user->id}";

        $this->recommendations = Cache::remember($cacheKey, now()->addHours(6), function () use ($user) {
            $service = new TravelRecommendationService($user);

            // Use LLM only if enough history exists
            return $service->getRecommendations(limit: 8, useLlm: true);
        });

        $this->loading = false;
    }

    public function refreshRecommendations()
    {
        $user = Auth::user();
        if (!$user)
            return;

        Cache::forget("user_recommendations_{$user->id}");

        $this->mount();
    }
    public function render()
    {
        return view('livewire.flight.recommended-carousel');
    }
}
