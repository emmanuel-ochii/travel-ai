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
    public $useLlm = true; // toggle LLM enhancements
    public $limit = 8;

    public function mount()
    {
        $this->loadLocalRecommendations();

        if ($this->useLlm) {
            // In Livewire 2.x, we cannot dispatch browser events
            // Just load LLM recommendations in background
            $this->loadLlmRecommendations();
        }
    }

    /**
     * Load local (baseline) recommendations immediately.
     */
    protected function loadLocalRecommendations()
    {
        $user = Auth::user();
        if (!$user) {
            $this->loading = false;
            return;
        }

        $service = new TravelRecommendationService($user);
        $this->recommendations = $service->getRecommendations($this->limit, useLlm: false);
        $this->loading = false;
    }

    /**
     * Load LLM-enhanced recommendations and update carousel automatically.
     */
    public function loadLlmRecommendations()
    {
        $user = Auth::user();
        if (!$user)
            return;

        $cacheKey = "user_recommendations_{$user->id}_llm";

        $llmRecs = Cache::remember($cacheKey, now()->addDay(), function () use ($user) {
            $service = new TravelRecommendationService($user);
            return $service->getRecommendations($this->limit, useLlm: true);
        });

        if ($llmRecs->isNotEmpty()) {
            $this->recommendations = $llmRecs;
        }
    }

    /**
     * Optional manual refresh (button or JS trigger)
     */
    public function refreshRecommendations()
    {
        $user = Auth::user();
        if (!$user)
            return;

        Cache::forget("user_recommendations_{$user->id}_llm");
        $this->loadLlmRecommendations();
    }

    public function render()
    {
        return view('livewire.flight.recommended-carousel');
    }
}
