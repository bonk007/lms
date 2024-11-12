<?php

namespace App\Livewire\Assignments;

use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Livewire\Component;
use Livewire\WithPagination;

class Panel extends Component
{
    use WithPagination;

    public Course $course;

    protected function assignments(): Builder
    {
        return Assignment::query()
            ->with([
                'attempts' => function (HasMany $relation) {
                    return $relation->whereBelongsTo(auth()->user(), 'user')
                        ->where('scoring_status', 2);
                }
            ])
            ->whereBelongsTo($this->course, 'course')
            ->orderByDesc('id');
    }

    public function render(): View
    {
        return view('livewire.assignments.panel', [
            'assignments' => $this->assignments()->paginate()
        ]);
    }
}
