<?php

namespace App\Livewire\Flight;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use App\Services\TravelRecommendationService;


#[Layout('layouts.frontend')]
class RecommendedFlights extends Component
{
    public $recommendedFlights = [];
    public $useLlm = false;
    public $limit = 5;

    public function mount()
    {
        $service = new TravelRecommendationService(Auth::user());
        $this->recommendedFlights = $service->getRecommendations($this->limit, $this->useLlm);
    }

    public function toggleLLM()
    {
        $this->useLlm = !$this->useLlm;
        $service = new TravelRecommendationService(Auth::user());
        $this->recommendedFlights = $service->getRecommendations($this->limit, $this->useLlm);
    }
    public function render()
    {
        return view('livewire.flight.recommended-flights');
    }
}
