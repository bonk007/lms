<?php

namespace App\Livewire\Dashboard\Quizzes\Sections;

use App\Models\QuizSection;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Panel extends Component
{
    public QuizSection $section;

    public bool $showSectionForm = false;

    public function render(): View
    {
        return view('livewire.dashboard.quizzes.sections.panel');
    }
}
