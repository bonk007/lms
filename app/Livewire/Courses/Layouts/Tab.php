<?php

namespace App\Livewire\Courses\Layouts;

use App\Models\Course;
use Livewire\Component;

class Tab extends Component
{
    public Course $course;

    public string $activeTab = 'course';

    public ?string $activeSubTab = null;

    public function switchTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.courses.layouts.tab');
    }
}
