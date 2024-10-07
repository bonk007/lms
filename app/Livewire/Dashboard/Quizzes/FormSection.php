<?php

namespace App\Livewire\Dashboard\Quizzes;

use App\Models\Quiz;
use App\Models\QuizSection;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class FormSection extends Component
{
    public ?Quiz $quiz = null;

    public ?Collection $sections = null;

    public ?QuizSection $editableSection = null;

    public bool $showSectionForm = false;

    protected $listeners = [
        'loadSections',
        'reloadSections',
        'closeForm'
    ];

    public function boot(): void
    {
        if ($this->quiz instanceof Quiz) {
            $this->loadSections($this->quiz);
        }
    }

    public function showForm(?QuizSection $section = null): void
    {
        $this->editableSection = $section;
        $this->showSectionForm = true;
    }

    public function closeForm(): void
    {
        $this->editableSection = null;
        $this->showSectionForm = false;
    }

    public function loadSections(Quiz $quiz): void
    {
        $this->quiz = $quiz->loadMissing(['sections.questions']);
        $this->sections = $this->quiz->sections;
    }

    public function reloadSections(): void
    {
        $this->quiz->refresh();
        $this->sections = $this->quiz->sections;
    }

    public function render(): View
    {
        return view('livewire.dashboard.quizzes.form-section');
    }
}
