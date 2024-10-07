<?php

namespace App\Models\Sessions;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseSession extends Model
{
    /** @inheritDoc */
    protected $fillable = [
        'course_id',
        'user_id',
        'last_activity_at',
        'completed_at'
    ];

    /** @inheritDoc */
    protected $casts = [
        'completed_at' => 'datetime',
        'last_activity_at' => 'datetime'
    ];

    /** @inheritDoc */
    protected $appends = [
        'completed'
    ];

    /**
     * Get associated course
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get related user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Determines the session was completed
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function completed(): Attribute
    {
        return new Attribute(get: fn(): bool => $this->getAttribute('completed_at') !== null);
    }

    public function complete(): self
    {
        $this->setAttribute('completed_at', $this->freshTimestamp())->save();
        return $this;
    }
}
