<?php

namespace App\Livewire\Dashboard\Courses;

use App\Models\Course;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Detail extends Component
{
    public Course $course;

    public array $subPages = [
        ['title' => 'Topics', 'component' => 'dashboard.courses.topics'],
        ['title' => 'Participants', 'component' => null],
        ['title' => 'Assignments', 'component' => 'dashboard.assignment.panel'],
        ['title' => 'Discussions', 'component' => 'discussion.panel'],
    ];

    public int $subPageIndex = 0;

    public function toSubPage(int $index): void
    {
        if (!isset($this->subPages[$index])) {
            $this->subPageIndex = 0;
            return;
        }

        $this->subPageIndex = $index;
    }

    public function render(): View
    {
        return view('livewire.dashboard.courses.detail');
    }
}
