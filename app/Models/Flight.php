<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline_id',
        'flight_number',
        'origin_airport_id',
        'destination_airport_id',
        'depart_at',
        'arrive_at',
        'duration_minutes',
        'stops',
        'base_price_cents',
        'currency',
    ];

    protected $casts = [
        'depart_at' => 'datetime',
        'arrive_at' => 'datetime',
    ];

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function origin()
    {
        return $this->belongsTo(Airport::class, 'origin_airport_id');
    }

    public function destination()
    {
        return $this->belongsTo(Airport::class, 'destination_airport_id');
    }

    public function segments()
    {
        return $this->hasMany(FlightSegment::class);
    }

    public function fares()
    {
        return $this->hasMany(Fare::class);
    }
}
