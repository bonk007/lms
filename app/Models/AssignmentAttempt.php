<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AssignmentAttempt extends Model
{
    /** @inheritdoc */
    protected $fillable = [
        'user_id',
        'assignment_id',
        'response',
        'scores',
        'scoring_status'
    ];

    /** @inheritdoc */
    protected $casts = [
        'scores' => 'double'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public function attachments(): BelongsToMany
    {
        return $this->belongsToMany(Attachment::class, 'assignment_attempt_attachment', 'assignment_attempt_id', 'attachment_id');
    }
}
