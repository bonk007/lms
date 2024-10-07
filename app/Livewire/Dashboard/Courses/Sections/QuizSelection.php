<?php

namespace App\Livewire\Dashboard\Courses\Sections;

use App\Livewire\Dashboard\Courses\TopicItem;
use App\Models\Quiz;
use App\Models\Section;
use App\Models\Snapshots\QuizSnapshot;
use App\Models\Topic;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class QuizSelection extends ModalComponent
{
    public Topic $topic;

    public ?Section $section = null;

    public ?Quiz $quiz = null;

    public function mount(): void
    {
        $this->initQuiz();
    }

    protected function initQuiz(): void
    {
        $content = $this->section?->loadMissing(['content'])->content;

        if (!$content instanceof QuizSnapshot) {
            return;
        }

        $this->quiz = $content->quiz;
    }

    public function select(Quiz $quiz): void
    {
        $this->quiz = $quiz;
    }

    public function submit(): void
    {
        if (null === $this->quiz) {
            return;
        }

        if (null !== $this->section?->getKey()) {
            $this->update();
            return;
        }

        $this->create();
    }

    protected function update(): void
    {
        $this->section?->makeQuizSnapshot($this->quiz);
        $this->saved();
    }

    protected function create(): void
    {
        DB::transaction(function () {
            $section = new Section([
                'visible' => true
            ]);
            $section->topic()->associate($this->topic)->save();
            $section->makeQuizSnapshot($this->quiz);

            $this->section = $section;
        });

        $this->saved();
    }

    protected function saved(): void
    {
        $this->closeModal();
        $this->dispatch('closeModal')->to(ContentOptions::class);
        $this->dispatch('reload')->to(TopicItem::class);

    }

    public function render(): View
    {
        return view('livewire.dashboard.courses.sections.quiz-selection');
    }
}
