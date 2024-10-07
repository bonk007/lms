<?php

namespace App\Livewire\Dashboard\Courses;

use App\Models\Course;
use App\Models\Enrollment;
use App\Services\Enrollment\Query;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Participants extends Component
{
    use WithPagination;

    public string $search = '';

    public Course $course;

    protected Query $query;

    public function mount(): void
    {
        $this->query = new Query(
            Enrollment::query()->with([
                'user'
            ])->whereBelongsTo($this->course, 'course')
        );
    }

    public function render(): View
    {
        $participants = $this->query
            ->filter([])
            ->orderBy('id', 'desc')
            ->build()
            ->paginate();

        return view('livewire.dashboard.courses.participants', [
            'participants' => $participants
        ]);
    }
}
