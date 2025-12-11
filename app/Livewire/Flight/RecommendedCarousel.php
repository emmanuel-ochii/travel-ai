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
    public $useLlm = true;
    public $limit = 8;

    // Add these properties to capture search context
    public $origin = null;
    public $destination = null;

    // Map query string parameters to properties
    protected $queryString = [
        'origin' => ['except' => '', 'as' => 'from'],
        'destination' => ['except' => '', 'as' => 'to']
    ];

    public function mount()
    {
        // Try to grab from request if not set via props
        $this->origin = $this->origin ?? request()->query('from');
        $this->destination = $this->destination ?? request()->query('to');

        $this->loadLocalRecommendations();

        if ($this->useLlm) {
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

        // Pass the explicit origin/destination
        $this->recommendations = $service->getRecommendations(
            $this->limit,
            false,
            $this->origin,
            $this->destination
        );

        $this->loading = false;
    }

    /**
     * Load LLM-enhanced recommendations.
     * We rely on the Service to handle caching to ensure the key includes the route.
     */
    public function loadLlmRecommendations()
    {
        $user = Auth::user();
        if (!$user)
            return;

        // Call service with useLlm: true
        // The Service handles the caching key (user + route + type)
        $service = new TravelRecommendationService($user);
        $llmRecs = $service->getRecommendations(
            $this->limit,
            true,
            $this->origin,
            $this->destination
        );

        if ($llmRecs->isNotEmpty()) {
            $this->recommendations = $llmRecs;
        }
    }

    /**
     * Manual refresh
     */
    public function refreshRecommendations()
    {
        $user = Auth::user();
        if (!$user)
            return;

        // Clear the specific cache key in the service
        // Note: This matches the key structure in the Service
        $cacheKey = "user_{$user->id}_recs_{$this->origin}_{$this->destination}_llm";
        Cache::forget($cacheKey);

        $this->loadLlmRecommendations();
    }

    public function render()
    {
        return view('livewire.flight.recommended-carousel');
    }
}
