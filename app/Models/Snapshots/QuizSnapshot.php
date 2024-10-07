<?php

namespace App\Models\Snapshots;

use App\Models\Contracts\CourseContent;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizSection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizSnapshot extends Model implements CourseContent
{
    use HasFactory;

    /** @inheritdoc */
    protected $fillable = [
        'course_id',
        'quiz_id',
        'quiz_data',
        'structure'
    ];

    /** @inheritdoc */
    protected $casts = [
        'quiz_data' => 'array',
        'structure' => 'collection'
    ];

    protected $with = ['quiz'];

    /**
     * Get related course
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get associated quiz
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    /**
     * Make a snapshot
     * @param \App\Models\Course $course
     * @param \App\Models\Quiz $quiz
     * @return self
     */
    public static function make(Course $course, Quiz $quiz): self
    {
        /** @var \Illuminate\Database\Eloquent\Collection $sections */
        $sections = $quiz->loadMissing(['sections.questions'])->getAttribute('sections');
        $model = new static([
            'quiz_data' => $quiz->only([
                'title',
                'subtitle',
                'automated_scoring',
                'duration',
            ]),
            'structure' => $sections->map(function (QuizSection $section) {
                return $section->append('randomized_questions');
            })
        ]);

        $model->course()->associate($course);
        $model->quiz()->associate($quiz);

        $model->save();

        return $model;
    }
}
