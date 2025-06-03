<?php

namespace App\Models\AUI\Stepper;

use App\Models\Course;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SectionMapping extends Model
{
    protected $fillable = [
        'course_id',
        'section_id',
        'marked_as'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
