<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'going_at',
        'title',
        'subtitle',
        'action_url',
    ];

    protected $casts = [
        'going_at' => 'timestamp'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}