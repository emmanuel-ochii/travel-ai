<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'flight_id', 'fare_id', 'passengers', 'total_price_cents', 'currency', 'status', 'booking_reference'
    ];

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
        return $this->belongsTo(\App\Models\User::class);
    }
}
