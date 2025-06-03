<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gaze extends Model
{
    protected $fillable = [
        'activity',
        'fixation',
        'amplitude',
        'velocity',
        'gaze_transition_entropy',
        'relative_gte',
        'transition_diversity_index',
        'dynamic_gte',
        'total_transitions',
        'cl_status'
    ];

    protected function casts(): array
    {
        return [
            'fixation' => 'array',
            'amplitude' => 'array',
            'velocity' => 'array',
            'gaze_transition_entropy' => 'double',
            'relative_gte' => 'double',
            'transition_diversity_index' => 'double',
            'dynamic_gte' => 'double',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
