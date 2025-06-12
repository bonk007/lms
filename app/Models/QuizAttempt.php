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
            $attempt->doCorrection();
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
        $this->loadMissing(['snapshot']);
        $snapshot = $this->getAttribute('snapshot');
        $quizData = $snapshot->getAttribute('quiz_data');
        $endedAt = $this->getAttribute('ended_at');

        if (null === $this->progress || null !== $endedAt) {
            return;
        }

        $progress = collect($this->getAttribute('latest_progress'));
        Question::query()
            ->whereIn('id', $progress->pluck('question_id'))
            ->each(static function (Question $question) use ($progress, &$correctedProgress) {

                if (in_array($question->type, ['short-answer', 'essay'])) {
                    return;
                }

                $progress->transform(function (array $item) use ($question, ) {
                    $options = $question->getAttribute('options');
                    $answer = $item['answer'];

                    if ($answer === null || !isset($options[$answer]) || $item['question_id'] !== $question->id) {
                        return $item;
                    }

                    $item['correct'] = $options[$answer]['correct'];

                    return $item;
                });

            });

        $correctAnswer = $progress->where('correct', true)->count();

        $this->setAttribute('progress', $progress)
            ->setAttribute('scores', ($correctAnswer / $progress->count()) * 100)
            ->setAttribute('ended_at', $this->freshTimestamp());
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

    public function scoringStatusText(): Attribute
    {
        return new Attribute(get: function() {
            $status = ["pending", "on going", "completed"];
            $scoringStatus = $this->getAttribute('scoring_status');

            return $status[$scoringStatus] ?? $status[0];
        });
    }
}
