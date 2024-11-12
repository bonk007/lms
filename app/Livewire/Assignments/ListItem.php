<?php

namespace App\Livewire\Assignments;

use App\Models\Assignment;
use App\Models\AssignmentAttempt;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ListItem extends Component
{
    public Assignment $assignment;

    public Course $course;

    public ?AssignmentAttempt $attempt = null;

    public function boot(): void
    {
        $this->attempt = $this->assignment->getAttribute('attempts')->first();
    }

    public function isTaken(): bool
    {
        return $this->attempt instanceof AssignmentAttempt;
    }

    public function render(): View
    {
        return view('livewire.assignments.list-item');
    }
}
