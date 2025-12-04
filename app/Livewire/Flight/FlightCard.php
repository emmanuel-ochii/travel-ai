<?php

namespace App\Livewire\Flight;

use Livewire\Component;
use App\Models\Flight;
use App\Models\UserInteraction;
use App\Services\InteractionLogger;
use Illuminate\Support\Facades\Auth;

class FlightCard extends Component
{
    public $flight;
    public $hasVoted = false;
    public $alreadyLiked = null;

    public function mount($flight)
    {
        $this->flight = $flight;

        if (Auth::check()) {
            $interaction = UserInteraction::where('user_id', Auth::id())
                ->where('type', 'feedback')
                ->where('payload->flight_id', $flight->id)
                ->first();

            if ($interaction) {
                $this->hasVoted = true;
                $this->alreadyLiked = $interaction->payload['liked'];
            }
        }
    }

    public function viewDetails()
    {
        if (isset($this->flight->id)) {
            return redirect()->route('flights.details', ['flight' => $this->flight->id]);
        }

        session()->flash('message', 'Detailed view not available for provider flights in mock.');
    }

    public function vote($liked)
    {
        if ($this->hasVoted)
            return;

        InteractionLogger::log('feedback', [
            'flight_id' => $this->flight->id,
            'liked' => (bool) $liked,
        ]);

        $this->hasVoted = true;
        $this->alreadyLiked = $liked;

        // Optional: toast
        session()->flash('message', $liked ? 'Thanks for liking!' : 'Feedback submitted!');
    }


    public function render()
    {
        return view('livewire.flight.flight-card');
    }
}
