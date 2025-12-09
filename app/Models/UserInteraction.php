<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserInteraction extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'type',    // search, view, book, feedback
        'payload', // JSON for details
        'ip',
        'user_agent',
        'created_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public static function log(string $type, array $payload = [], ?\Illuminate\Http\Request $request = null)
    {
        return \App\Services\InteractionLogger::log($type, $payload, $request);
    }
}
