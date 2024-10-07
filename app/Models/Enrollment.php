<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 0;

    public const STATUS_APPROVED = 1;

    public const STATUS_BLACKLISTED = 99;

    public const TYPE_SELF = 1;

    public const TYPE_INVITATION = 2;

    /** @inheritdoc */
    protected $fillable = [
        'course_id',
        'user_id',
        'status',
        'type',
    ];

    /**
     * Get related course
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get associated user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
