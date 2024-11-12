<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Assignment extends Model
{
    use HasFactory, SoftDeletes;

    /** @inheritDoc */
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'started_at',
        'duration',
        'duration_unit'
    ];

    /** @inheritDoc */
    protected $casts = [
        'started_at' => 'datetime'
    ];

    protected $appends = [
        'ended_at',
        'is_expired',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get attached files
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attachments(): BelongsToMany
    {
        return $this->belongsToMany(Attachment::class, 'assignment_attachment', 'assignment_id', 'attachment_id');
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(AssignmentAttempt::class, 'assignment_id');
    }

    public function endedAt(): Attribute
    {
        return new Attribute(get: function (): ?Carbon {
            if ($this->getAttribute('duration') === null || $this->getAttribute('duration_unit') === null) {
                return null;
            }

            return match ($this->getAttribute('duration_unit')) {
                'minutes' => $this->getAttribute('started_at')->addMinutes($this->getAttribute('duration')),
                'hours' => $this->getAttribute('started_at')->addHours($this->getAttribute('duration')),
                default => $this->getAttribute('started_at')->addDays($this->getAttribute('duration')),
            };

        });
    }

    public function isExpired(): Attribute
    {
        return new Attribute(get: function (): bool {
            return $this->getAttribute('ended_at') !== null
                && $this->getAttribute('ended_at')->lte(now());
        });
    }
}
