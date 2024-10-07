<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    /** @inheritDoc */
    protected $fillable = [
        'created_by',
        'html_content',
        'content_url',
        'content_mime',
        'streaming',
        'type',
        'options'
    ];

    /** @inheritDoc */
    protected $casts = [
        'streaming' => 'boolean',
        'options' => 'array',
    ];

    /** @inheritDoc */
    protected $hidden = [
        'options'
    ];

    /** @inheritDoc */
    protected $appends = [
        'options_without_key'
    ];

    /**
     * Get associated user as the creator
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get associated quiz sections
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function quizSections(): BelongsToMany
    {
        return $this->belongsToMany(QuizSection::class, 'questions_sections', 'question_id', 'quiz_section_id');
    }

    /**
     * Hide answer key for options
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function optionsWithoutKey(): Attribute
    {
        return new Attribute(get: function (): ?array {

            $options = $this->getAttribute('options');

            if (null === $options || !in_array($this->getAttribute('type'), ['single-choice', 'multiple-choices'])) {
                return null;
            }

            return Arr::map($options, static fn (array $item) => Arr::except($item, 'correct'));
        });
    }
}
