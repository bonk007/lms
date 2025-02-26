<?php

namespace App\Livewire\Dashboard\Quizzes;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Livewire\Component;

/**
 * sonarr/radarr -- catalogue
 * prowlarr -- crawler
 * jellyfin/plex/emby -- media player
 */
class Form extends Component
{
    public User $user;

    public ?Quiz $quiz = null;

    public string $pageTitle = '';

    public string $title = '';

    public string $subtitle = '';

    public bool $automatedScoring = false;

    public ?int $duration = null;

    public function mount(): void
    {
        $this->title = $this->quiz?->title ?? '';
        $this->subtitle = $this->quiz?->subtitle ?? '';
        $this->automatedScoring = $this->quiz?->getAttribute('automated_scoring') ?? false;
        $this->duration = $this->quiz?->getAttribute('duration');
    }

    public function submit(): void
    {
        $validatedData = $this->validate([
            'title' => ['required', 'max:255'],
            'subtitle' => ['sometimes', 'max:255'],
            'automatedScoring' => ['bool'],
            'duration' => ['sometimes', 'integer', 'min:1']
        ]);

        $data = Arr::except([
            ...$validatedData,
            ...['automated_scoring' => $validatedData['automatedScoring']]
        ], 'automatedScoring');

        if ($this->quiz instanceof Quiz) {
            $this->update($data);
            return;
        }

        $this->create($data);
    }

    protected function create(array $validatedData): void
    {
        $quiz = new Quiz($validatedData);
        $quiz->creator()->associate($this->user)->save();

        $this->quiz = $quiz;
        $this->dispatch('infoSaved', [
            'quiz' => $this->quiz->getKey()
        ])->to(FormPanel::class);
    }

    protected function update(array $validatedData): void
    {
        $this->quiz->update($validatedData);
        $this->dispatch('infoSaved', [
            'quiz' => $this->quiz->getKey()
        ])->to(FormPanel::class);
    }


    public function render(): View
    {
        return view('livewire.dashboard.quizzes.form');
    }
}
