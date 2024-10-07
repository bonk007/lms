<?php

namespace App\Livewire\Dashboard\Quizzes\Sections;

use App\Livewire\Dashboard\Quizzes\FormSection;
use App\Models\Quiz;
use App\Models\QuizSection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Livewire\Component;

class Form extends Component
{
    public Quiz $quiz;

    public ?QuizSection $section = null;

    public string $title = '';
    public string $subtitle = '';
    public string $description = '';
    public bool $randomQuestions = false;

    public function boot(): void
    {
        $this->title = $this->section?->title ?? '';
        $this->subtitle = $this->section?->subtitle ?? '';
        $this->description = $this->section?->description ?? '';
        $this->randomQuestions = $this->section?->getAttribute('random_order_questions') ?? false;
    }

    protected function create(array $data): void
    {
        $this->section = $this->quiz->sections()
            ->create($data);
        $this->closeForm();
    }

    public function update(array $data): void
    {
        $this->section?->update($data);
        $this->closeForm();
    }

    public function submit(): void
    {
        $data = $this->validate([
            'title' => ['required', 'max:255'],
            'subtitle' => ['sometimes', 'max:255'],
            'description' => ['sometimes'],
            'randomQuestions' => ['bool'],
        ]);

        $data = [
            ...(Arr::except($data, ['randomQuestions'])),
            ...['random_order_questions' => $data['randomQuestions']]
        ];

        if ($this->section?->getKey() !== null) {
            $this->update($data);
            return;
        }

        $this->create($data);
    }

    public function closeForm(): void
    {
        $this->dispatch('closeForm')->to(FormSection::class);
    }

    public function render(): View
    {
        return view('livewire.dashboard.quizzes.sections.form');
    }
}
