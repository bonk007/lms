<?php

namespace App\Livewire\Courses\Layouts\Partial;

use App\Livewire\Courses\Concerns\WithSectionMapping;
use App\Models\Course;
use Livewire\Component;

class CourseTabs extends Component
{
    use WithSectionMapping;

    public Course $course;

    public string $activeTab = 'reading';

    public function switch(string $tab): void
    {
        $tabs = ['reading', 'watching', 'quiz'];

        if ($tab === $this->activeTab || !in_array($tab, $tabs)) {
            return;
        }

        $this->activeTab = $tab;
    }

    public function render()
    {
        $mapping = $this->getMap();
        return view('livewire.courses.layouts.partial.course-tabs', compact('mapping'));
    }
}
