<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GazerRecord extends Model
{
    protected $fillable = [
        'user_id',
        'section_id',
        'url',
        'data',
        'normalized_data',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'normalized_data' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
