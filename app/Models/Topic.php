<?php

namespace App\Models;

use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    use HasFactory, Sortable;

    /** @inheritDoc */
    protected $fillable = [
        'course_id',
        'created_by',
        'depends_on',
        'published_at',
        'sort_index',
        'title',
        'subtitle',
        'description',
        'completion_estimation'
    ];

    /** @inheritDoc */
    protected $casts = [
        'published_at' => 'datetime'
    ];

    protected $with = [
        'sections'
    ];

    /** @inheritDoc */
    protected static function boot(): void
    {
        parent::boot();
        static::saving(static fn(Topic $topic) => $topic->initSortIndex());
    }

    public function published(): Attribute
    {
        return new Attribute(
            get: fn(): bool => $this->getAttribute('published_at') instanceof \DateTimeInterface
        );
    }

    /**
     * Get related user as course creator
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get associated course
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get associated dependant's topic.
     * Certain topic will available after dependant topic was completed
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dependencyTopic(): BelongsTo
    {
        return $this->belongsTo(static::class, 'depends_on');
    }

    public function relies(): HasMany
    {
        return $this->hasMany(static::class, 'depends_on');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'topic_id')
            ->orderBy('sort_index');
    }

    /**
     * @inheritDoc
     */
    protected function parentRelation(): array
    {
        return [$this->loadMissing('course')->course, 'course'];
    }
}
