<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_id', 'fare_class', 'price_cents', 'currency', 'refundable', 'baggage_allowance', 'rules_json'
    ];

    protected $casts = [
        'refundable' => 'boolean',
        'rules_json' => 'array',
    ];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}
