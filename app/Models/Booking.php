<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'flight_id',
        'fare_id',
        'passengers',
        'total_price_cents',
        'currency',
        'status',
        'booking_reference'
    ];

   // -----------------------------
    // RELATIONSHIPS
    // -----------------------------
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function fare()
    {
        return $this->belongsTo(Fare::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // -----------------------------
    // GENERATE BOOKING REFERENCE
    // -----------------------------
    public static function generateReference()
    {
        return 'BK-' . strtoupper(uniqid());
        // Example: BK-65FA4C9923A8
    }
}
