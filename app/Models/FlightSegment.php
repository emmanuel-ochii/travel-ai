<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightSegment extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_id',
        'segment_index',
        'origin_airport_id',
        'destination_airport_id',
        'depart_at',
        'arrive_at',
        'duration_minutes',
        'equipment',
    ];

    protected $casts = [
        'depart_at' => 'datetime',
        'arrive_at' => 'datetime',
    ];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function origin()
    {
        return $this->belongsTo(Airport::class, 'origin_airport_id');
    }

    public function destination()
    {
        return $this->belongsTo(Airport::class, 'destination_airport_id');
    }
}
