<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopularRoute extends Model
{
    protected $fillable = [
        'origin',
        'destination',
        'search_count',
        'calculated_at'
    ];

    public $timestamps = false;
    protected $casts = [
        'calculated_at' => 'datetime',
    ];
}
