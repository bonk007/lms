<?php

namespace App\Livewire\Dashboard\Quizzes;

use App\Models\Quiz;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FormPanel extends Component
{
    public string $title = '';

    public ?Quiz $quiz = null;

    public bool $enabledFormSection = false;

    public int $tabIndex = 0;

    protected $listeners = [
        'infoSaved'
    ];

    public function boot(): void
    {
        $this->enabledFormSection = $this->quiz instanceof Quiz;
    }

    public function switchTab(int $index): void
    {
        if ($index > 0 && !$this->enabledFormSection) {
            return;
        }

        $this->tabIndex = $index;
    }

    public function infoSaved(Quiz $quiz): void
    {
        $this->quiz = $quiz;
        $this->enableFormSection();
    }

    protected function enableFormSection(): void
    {
        $this->enabledFormSection = true;
        $this->dispatch('loadSections', ['quiz' => $this->quiz->getKey()])
            ->to(FormSection::class);
    }

    public function render(): View
    {
        return view('livewire.dashboard.quizzes.form-panel');
    }
}
