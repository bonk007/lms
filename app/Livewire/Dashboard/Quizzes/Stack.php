<?php

namespace App\Livewire\Dashboard\Quizzes;

use App\Models\Quiz;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Livewire\Component;

class Stack extends Component
{
    public string $title = '';

    public string $search = '';

    public string $orderBy = 'title';

    public string $direction = 'desc';

    public array $sortingOptions = [];

    public bool $enableSelection = false;

    public $selectedQuiz = null;

    protected function query(): Builder
    {
        $query = Quiz::with([
            'sections.questions'
        ])->whereBelongsTo(auth()->user(), 'creator')
            ->when(strlen($this->search) > 2, fn(Builder $query) =>
            $query->whereNested(fn($query) => $query->where('title', 'ilike', strtolower($this->search) . '%')->orWhere('subtitle', 'ilike', strtolower($this->search) . '%')) );

        return match ($this->orderBy) {
            'duration' => $query->orderBy('duration', $this->direction),
            'title' => $query->orderBy('title', $this->direction),
            default => $query->orderBy('created_at', $this->direction),
        };
    }

    public function mount(): void
    {
        $this->sortingOptions = [
            ['id' => 'title' , 'label' => __('Title'),],
            ['id' => 'date' , 'label' => __('Date Creation'),],
            ['id' => 'duration' , 'label' => __('Duration')],
        ];
    }

    public function changeOrderBy(string $selection): void
    {
        $this->orderBy = array_key_exists(strtolower($selection), Arr::pluck($this->sortingOptions, 'id'))
            ? $selection
            : 'title';
    }

    public function changeOrderDir(string $dir): void
    {
        $this->direction = in_array(strtolower($dir), ['asc', 'desc']) ?
            $dir : 'desc';
    }

    public function quizSelected(): void
    {
        if ($this->selectedQuiz === null) {
            return;
        }

        $this->dispatch('quiz-selected', ['quiz' => $this->selectedQuiz]);
    }

    public function render(): View
    {
        $quizzes = $this->query()->paginate();
        return view('livewire.dashboard.quizzes.stack', compact('quizzes'));
    }
}
