<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Resource extends Model
{
    use HasFactory, SoftDeletes;

    /** @inheritdoc */
    protected $fillable = [
        'created_by',
        'title',
        'abstract',
        'html_content',
        'content_url',
        'content_mime',
        'streaming',
        'downloadable',
    ];

    /** @inheritdoc */
    protected $casts = [
        'streaming' => 'boolean',
        'downloadable' => 'boolean',
    ];

    public function streamable(): Attribute
    {
        return new Attribute(get: function () {
            return $this->streaming
                && $this->getAttribute('content_mime') !== 'application/pdf'
                && null !== $this->getAttribute('content_url');
        });
    }

    public function contentPublicUrl(): Attribute
    {
        return new Attribute(get: function () {
            return $this->getAttribute('content_url') === null ? null : Storage::url($this->getAttribute('content_url'));
        });
    }

    /**
     * Get associated user as the creator
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function slides(): BelongsToMany
    {
        return $this->belongsToMany(Slide::class, 'resource_slide', 'resource_id', 'slide_id');
    }
}
