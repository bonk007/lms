<?php

namespace App\Livewire\Dashboard\Courses;

use App\Models\Course;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Detail extends Component
{
    public Course $course;


    public function render(): View
    {
        return view('livewire.dashboard.courses.detail');
    }
}
