<?php

namespace App\Livewire\Assignments;

use App\Models\Assignment;
use App\Models\AssignmentAttempt;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class Detail extends Component
{
    public Assignment $assignment;

    public Course $course;

    public ?AssignmentAttempt $attempt = null;

    public ?float $score = null;

    public function boot(): void
    {
        $this->attempt = $this->assignment->getAttribute('attempts')->first();
        $this->score = $this->attempt?->getAttribute('scores');
    }

    public function render(): View
    {
        return view('livewire.assignments.detail');
    }
}
