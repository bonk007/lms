<?php

namespace App\Livewire\Dashboard\Assignment;

use App\Models\Assignment;
use App\Models\AssignmentAttempt;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Attempts extends Component
{
    use WithPagination;

    public Assignment $assignment;

    public Course $course;

    protected function attempts(): Builder
    {
        // 2011831602
        // halobca@bca.co.id
        return AssignmentAttempt::query()
            ->with([
                'attachments'.
                'user'
            ])
            ->whereBelongsTo($this->assignment, 'assignment');
    }

    public function render(): View
    {
        return view('livewire.dashboard.assignment.attempts', [
            'attempts' => $this->attempts()->paginate()
        ]);
    }
}
