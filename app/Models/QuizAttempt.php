<?php

namespace App\Models;

use App\Models\Snapshots\QuizSnapshot;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;

class QuizAttempt extends Model
{
    /** @inheritDoc */
    protected $fillable = [
        'user_id',
        'quiz_snapshot_id',
        'ended_at',
        'scores',
        'scoring_status',
        'passed',
        'progress'
    ];

    /** @var string[]  */
    protected $casts = [
        'ended_at' => 'datetime',
        'scores' => 'double',
        'passed' => 'boolean',
        'progress' => 'array',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saving(static function (QuizAttempt $attempt) {
//            $attempt->doCorrection();
        });
    }

    public function latestProgress(): Attribute
    {
        return new Attribute(get: function (): ?array {
            // progress should be formed
            // [{quiz_section_id:1, data: [{question_id: 1, answer: [0], correct: true}, {question_id: 2, answer: [1], correct: false}]}]
            return collect($this->getAttribute('progress'))->last();

        });
    }

    public function doCorrection(): void
    {
        $this->loadMissing(['quizSnapshot']);
        $snapshot = $this->getAttribute('quizSnapshot');
        $quizData = $snapshot->getAttribute('quiz_data');

        if (null === $this->progress || !$quizData['auto_correction']) {
            return;
        }

        $progress = collect($this->getAttribute('latest_progress'));
        Question::query()
            ->whereIn('id', $progress->pluck('question_id'))
            ->each(static function (Question $question) use ($progress) {

                if (in_array($question->type, ['short-answer', 'essay'])) {
                    return;
                }

                $progress->where('question_id', $question->id)
                    ->transform(function (array $item) use ($question) {

                    });
            });
    }

    /**
     * Get related user who attempted
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get related quiz snapshot
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function snapshot(): BelongsTo
    {
        return $this->belongsTo(QuizSnapshot::class, 'quiz_snapshot_id');
    }
}