<?php

namespace App\Livewire\Dashboard\Quizzes\Modal;

use App\Livewire\Dashboard\Quizzes\FormSection;
use App\Models\Question;
use App\Models\QuizSection;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class UnassignQuestionConfirmation extends ModalComponent
{
    public Question $question;
    public QuizSection $section;

    public function confirm(): void
    {
        $this->section->questions()
            ->detach($this->question);

        $this->dispatch('reloadSections')->to(FormSection::class);
        $this->closeModal();
    }

    public function render(): View
    {
        return view('livewire.dashboard.quizzes.modal.unassign-question-confirmation');
    }
}
