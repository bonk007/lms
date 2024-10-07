<?php

namespace App\Models;

use App\Models\Snapshots\QuizSnapshot;
use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\DB;

class Section extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'topic_id',
        'content_id',
        'content_type',
        'visible',
        'sort_index',
    ];

    protected $casts = [
        'visible' => 'boolean'
    ];

    /** @inheritDoc */
    protected static function boot(): void
    {
        parent::boot();
        static::saving(static fn(Section $section) => $section->initSortIndex());
    }

    /**
     * Get related topic
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    /**
     * Get related content model
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function content(): MorphTo
    {
        return $this->morphTo('content');
    }

    public function makeQuizSnapshot(Quiz $quiz): void
    {
        DB::transaction(function () use ($quiz) {
            $this->loadMissing(['topic.course']);
            /** @var \App\Models\Course $course */
            $course = $this->getAttribute('topic')->getAttribute('course');
            $snapshot = QuizSnapshot::make($course, $quiz);

            $this->content()->associate($snapshot)->save();
        });
    }

    /** @inheritDoc */
    protected function parentRelation(): array
    {
        return [$this->loadMissing(['topic'])->topic, 'topic'];
    }
}
