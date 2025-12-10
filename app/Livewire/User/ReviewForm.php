<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewForm extends Component
{

    public $total_flight_time;
    public $name;
    public $airline;
    public $class_type;
    public $review_text;
    public $bookingId;
    public $booking;
    public $hasReviewed = false; // Initialize to false

    // Mount receives Booking model
    public function mount($bookingId)
    {
        $this->booking = Booking::findOrFail($bookingId);

        if ($this->booking->user_id !== auth()->id() || $this->booking->status !== 'confirmed') {
            abort(403);
        }

        $this->hasReviewed = Review::where('booking_id', $this->booking->id)
            ->where('user_id', auth()->id())
            ->exists();

        $this->total_flight_time = $this->booking->flight->duration_minutes . ' mins';
        $this->name = auth()->user()->name;
        $this->airline = $this->booking->flight->airline->name ?? 'Unknown';
        $this->class_type = $this->booking->fare->class_type ?? 'Economy';
    }

    public function submitReview()
    {
        if ($this->hasReviewed) {
            return session()->flash('error', 'You have already reviewed this flight.');
        }

        $this->validate([
            'review_text' => 'required|max:400'
        ]);

        Review::create([
            'booking_id' => $this->booking->id,
            'user_id' => Auth::id(),
            'total_flight_time' => $this->total_flight_time,
            'name' => $this->name,
            'airline' => $this->airline,
            'class_type' => $this->class_type,
            'review_text' => $this->review_text,
        ]);

        $this->hasReviewed = true;
        session()->flash('success', 'Your review was successfully submitted!');
        $this->review_text = '';
    }

    public function render()
    {
        return view('livewire.user.review-form');
    }
}
