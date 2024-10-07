<?php

namespace App\Livewire\Quizzes;

use App\Events\QuizProgressUpdated;
use App\Models\QuizAttempt;
use App\Models\Snapshots\QuizSnapshot;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Attempt extends Component
{
    public QuizAttempt $attempt;

    public ?QuizSnapshot $snapshot = null;

    public array $quizData = [];

    public int $currentSection = 0;

    public array $currentStructure = [];

    public array $progressData = [];

    protected $listeners = ['completed'];

    public function mount(): void
    {
        $this->attempt->loadMissing([
            'snapshot'
        ]);

        $this->snapshot = $this->attempt->snapshot;
        $this->quizData = $this->snapshot->getAttribute('quiz_data');


        $structure = $this->snapshot?->structure;
        $this->currentSection = $this->attempt->progress === null ? 0 : count($this->attempt->progress);
        $this->currentStructure = $structure[$this->currentSection] ?? [];

        if (empty($this->currentStructure) || $this->attempt->getAttribute('ended_at') !== null) {
            $this->dispatch('completed');
            return;
        }

        $this->initProgressData();

    }

    protected function initProgressData(): void
    {
        $questions = $this->currentStructure['random_order_questions']
            ? $this->currentStructure['randomized_questions']
            : $this->currentStructure['questions'];

        foreach ($questions as $question) {
            $this->progressData[] = [
                'quiz_section_id' => $this->currentStructure['id'],
                'question_id' => $question['id'],
                'type' => $question['type'],
                'answer' => [],
                'correct' => false
            ];
        }
    }

    public function submit(): void
    {
        $progress = $this->answerAdapts($this->progressData);

        $currentProgress = $this->attempt->getAttribute('progress');
        $currentProgress[] = $progress;

        $this->attempt->update([
            'progress' => $currentProgress
        ]);

        event(new QuizProgressUpdated($this->attempt));

        $this->next();
    }

    protected function next(): void
    {
        $structure = $this->snapshot?->structure;
        ++$this->currentSection;
        $this->currentStructure = $structure[$this->currentSection] ?? [];
    }

    /**
     * Process the answer into accepted structure
     * @param array $progress
     * @param bool $reverse
     * @return array
     */
    protected function answerAdapts(array $progress, bool $reverse = false): array
    {
        $transform = !$reverse
            ? static function (array $item) {
                return [
                    ...$item,
                    ...[
                        'answer' => match($item['type']) {
                            'multiple-choices' => empty($item['answer']) ? null : array_keys($item['answer']),
                            'single-choice' => empty($item['answer']) ? null : (int) $item['answer'],
                            'boolean' => is_array($item['answer']) ? null : (bool) $item['answer'],
                            default => empty($item['answer']) ? null : $item['answer']
                        }
                    ]
                ];
            }
            : static function (array $item) {
                return [
                    ...$item,
                    ...['answer' => match($item['type']) {
                            'multiple-choices' => empty($item['answer']) ? [] : collect($item['answer'])->mapWithKeys(fn (int $answer) => [$answer => true])->toArray(),
                            'single-choice',
                            'boolean' => empty($item['answer']) ? [] : (int) $item['answer'],
                            default => empty($item['answer']) ? [] :  $item['answer']
                    }]
                ];
            };

        // from database to backend
        return collect($progress)
            ->map($transform)
            ->toArray();
    }

    public function completed(): void
    {

    }

    public function render(): View
    {
        return view('livewire.quizzes.attempt');
    }
}
