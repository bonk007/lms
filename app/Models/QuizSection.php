<?php

namespace App\Models;

use App\Models\Contracts\CourseContent;
use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection as ModelCollection;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class QuizSection extends Model implements CourseContent
{
    use HasFactory, Sortable;

    /** @inheritDoc */
    protected $fillable = [
        'quiz_id',
        'title',
        'subtitle',
        'description',
        'sort_index',
        'random_order_questions'
    ];

    /** @inheritDoc */
    protected $casts = [
        'random_order_questions' => 'boolean'
    ];

    /**
     * Get associated quiz instance
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    /**
     * Get assigned questions
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'questions_sections', 'quiz_section_id', 'question_id')
            ->orderBy('sort_index');
//            ->withPivotValue('sort_index');
    }

    /**
     * Get random questions in order
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function randomizedQuestions(): Attribute
    {
        return new Attribute(get: function (): ModelCollection|Collection {

            /** @var \Illuminate\Database\Eloquent\Collection $questions */
            $questions = $this->loadMissing(['questions'])->questions;

            if ($this->getAttribute('random_order_questions') !== true || $questions->isEmpty()) {
                return $questions;
            }

            return $questions->random();

        });
    }

    /**
     * @inheritDoc
     */
    protected function parentRelation(): array
    {
        return [$this->loadMissing(['quiz'])->quiz, 'quiz'];
    }
}
