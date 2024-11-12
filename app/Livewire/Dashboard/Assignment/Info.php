<?php

namespace App\Livewire\Dashboard\Assignment;

use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Info extends Component
{
    public Assignment $assignment;

    public Course $course;

    public function render(): View
    {
        return view('livewire.dashboard.assignment.info');
    }
}
