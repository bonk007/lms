<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    /** @inheritDoc */
    protected $fillable = [
        'conversation_id',
        'sent_by',
        'attachment_id',
        'reply_to',
        'read_at',
        'content'
    ];

    /** @inheritDoc */
    protected $casts = [
        'read_at' => 'datetime'
    ];

    protected $touches = [
        'conversation'
    ];

    public function attachment(): BelongsTo
    {
        return $this->belongsTo(Attachment::class, 'attachment_id');
    }

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    public function replied(): BelongsTo
    {
        return $this->belongsTo(static::class, 'reply_to');
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sent_by');
    }
}