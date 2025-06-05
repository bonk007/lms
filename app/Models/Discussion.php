<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discussion extends Model
{
    use HasFactory, SoftDeletes;

    /** @inheritdoc */
    protected $fillable = [
        'course_id',
        'initial_post_id',
        'created_by',
        'title',
        'closed_at',
    ];

    /** @inheritdoc  */
    protected $casts = [
        'closed_at' => 'timestamp'
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
     * Get related user as creator
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get related post that was created with the conversation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function initialPost(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'initial_post_id');
    }

    /**
     * Get related posts
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'discussion_id');
    }
}
