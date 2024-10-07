<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'automated_scoring',
        'duration',
    ];

    protected $casts = [
        'automated_scoring' => 'boolean'
    ];

    /**
     * Get associated user as the creator
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(QuizSection::class, 'quiz_id')
            ->orderBy('sort_index');
    }
}
