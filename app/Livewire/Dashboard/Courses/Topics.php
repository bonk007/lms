<?php

namespace App\Livewire\Dashboard\Courses;

use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Topics extends Component
{
    public Course $course;

    public Collection $topics;

    public function boot(): void
    {
        $this->topics = $this->course->topics()
            ->orderBy('sort_index')
            ->get();
    }

    public function render(): View
    {
        return view('livewire.dashboard.courses.topics');
    }
}
