<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Slide extends Model
{
    protected $fillable = [
        'published_at',
    ];

    protected $casts = [
        'published' => 'datetime',
    ];

    public function publish(): void
    {
        $this->fill(['published_at' => now()])->save();
    }

    public function published(): Attribute
    {
        return new Attribute(get: fn(): bool => $this->getAttribute('published_at') !== null);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(SlideItem::class, 'slide_id');
    }

    public function resources(): BelongsToMany
    {
        return $this->belongsToMany(Resource::class, 'resource_slide', 'slide_id', 'resource_id');
    }
}
