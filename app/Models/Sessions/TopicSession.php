<?php

namespace App\Models\Sessions;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TopicSession extends Model
{
    protected $fillable = [
        'course_session_id',
        'topic_id',
        'completed_at'
    ];

    protected $casts = [
        'completed_at' => 'datetime'
    ];

    protected $appends = [
        'completed'
    ];

    /**
     * Get associated topic
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    /**
     * Get related session of the course
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courseSession(): BelongsTo
    {
        return $this->belongsTo(CourseSession::class, 'course_session_id');
    }

    /**
     * Determines the user has been completed the topic
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function completed(): Attribute
    {
        return new Attribute(get: fn(): bool => $this->getAttribute('completed_at') !== null);
    }
}
