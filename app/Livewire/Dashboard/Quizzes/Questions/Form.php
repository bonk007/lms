<?php

namespace App\Livewire\Dashboard\Quizzes\Questions;

use App\Livewire\Dashboard\Quizzes\FormSection;
use App\Livewire\Dashboard\Traits\HasMultipleContent;
use App\Livewire\Traits\HasAlert;
use App\Models\Question;
use App\Models\QuizSection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class Form extends ModalComponent
{
    use WithFileUploads, HasAlert, HasMultipleContent;

    public QuizSection $section;
    public ?Question $question = null;

    public bool $isHTML = true;

    public string $content = '';

    public string $type = '';

    public array $types = [];

    public array $options = [];

    public bool $correct = true;

    public function boot(): void
    {
        $this->types = [
            ['key' => 'short-answer', 'label' => __("Short Answer")],
            ['key' => 'essay', 'label' => __("Essay")],
            ['key' => 'single-choice', 'label' => __("Single Choice")],
            ['key' => 'multiple-choices', 'label' => __("Multiple Choices")],
            ['key' => 'boolean', 'label' => __("True or False")],
        ];

    }

    public function mount(): void
    {
        if ($this->question?->getKey() !== null) {
            $this->isHTML = $this->question?->getAttribute('content_mime') === 'text/html';
            $this->type = $this->question?->getAttribute('type') ?? '';
            $this->content = $this->question?->getAttribute('html_content');
            $this->options = $this->question?->getAttribute('options');
        }
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function changeType(string $type): void
    {
        $this->type = $type;
    }

    public function toggleHtml(): void
    {
        $this->isHTML = !$this->isHTML;
    }

    public function newOption(): void
    {
        if (in_array($this->type, ['short-answer', 'essay', 'boolean'])) {
            $this->resetOptions();
            return;
        }

        $this->options[] = [
            'content' => '',
            'correct' => false
        ];
    }

    public function removeOption(int $index): void
    {
        if (!isset($this->options[$index])) {
            return;
        }

        unset($this->options[$index]);
    }

    public function resetOptions(): void
    {
        $this->options = [];
    }



    public function submit(): void
    {
        DB::transaction(function() {

            $data = [
                ...Arr::except($this->getValidatedData($this->getOptionsValidation()), ['file']),
                ...['options' => $this->getOptions(), 'type' => $this->type]
            ];

            if ($this->question?->getKey() !== null) {
                $this->update($data);
            } else {
                $this->create($data);
            }

            if (!$this->question instanceof Question) {
                return;
            }

            $this->uploadFile(get_class($this->question));
            $this->submitted();
            $this->closeModal();
        });
    }

    protected function create(array $data): void
    {
        $question = new Question($data);
        $question->creator()->associate(auth()->user())->save();

        $this->section->questions()
            ->attach($question, [
                'sort_index' => $this->section->questions()->count() + 1
            ]);

        $this->question = $question;

    }

    protected function update(array $data): void
    {
        $this->question->update($data);
    }

    protected function getOptionsValidation(): array
    {
        return match ($this->type) {
            'single-choice' => [
                'options.*.content' => ['required', 'max:255'],
                'options.*.correct' => ['boolean']
            ],
            default => []
        };
    }

    protected function getOptions(): array
    {
        return match($this->type) {
            'boolean' => ['correct' => $this->correct],
            'single-choice',
            'multiple-choices' => Arr::map($this->options, function (array $option) {
                $option['correct'] = (bool) $option['correct'];
                return $option;
            }),
            default => []
        };
    }

    public function submitted(): void
    {
        $this->dispatch('reloadSections')->to(FormSection::class);
    }

    public function render(): View
    {
        return view('livewire.dashboard.quizzes.questions.form');
    }
}
