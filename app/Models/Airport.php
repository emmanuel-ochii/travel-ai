<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = ['iata', 'icao', 'name', 'city', 'country', 'timezone'];

    public function departures()
    {
        return $this->hasMany(Flight::class, 'origin_airport_id');
    }

    public function arrivals()
    {
        return $this->hasMany(Flight::class, 'destination_airport_id');
    }
}
