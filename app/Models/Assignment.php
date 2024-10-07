<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
