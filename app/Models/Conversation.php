<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    use HasFactory;

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('is_initiator');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'conversation_id')
            ->orderByDesc('id');
    }
}
