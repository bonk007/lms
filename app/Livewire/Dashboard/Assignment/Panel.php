<?php

namespace App\Livewire\Dashboard\Assignment;

use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Panel extends Component
{
    use WithPagination;

    public Course  $course;

    protected $listeners = [
        'reload'
    ];

    public function reload(): void
    {
        $this->course->refresh();
    }

    protected function assignments(): Builder
    {
        return Assignment::query()
            ->with(['attachments', 'attempts.user'])
            ->withCount(['attempts'])
            ->whereBelongsTo($this->course, 'course');
    }

    public function render(): View
    {
        return view('livewire.dashboard.assignment.panel', [
            'assignments' => $this->assignments()->paginate()
        ]);
    }
}
