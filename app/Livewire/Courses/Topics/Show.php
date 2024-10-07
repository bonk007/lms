<?php

namespace App\Livewire\Courses\Topics;

use App\Models\Course;
use App\Models\Topic;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Show extends Component
{
    public Course $course;

    public Topic $topic;

    public function render(): View
    {
        return view('livewire.courses.topics.show');
    }
}
