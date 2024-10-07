<?php

namespace App\Livewire\Quizzes;

use App\Models\QuizAttempt;
use App\Models\Snapshots\QuizSnapshot;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Preface extends Component
{
    public User $user;

    public QuizSnapshot $snapshot;

    public array $data;

    public function mount(): void
    {
        $this->user = auth()->user();
        $this->data = $this->snapshot->getAttribute('quiz_data');
    }

    public function confirm(): void
    {
        $attempt = QuizAttempt::create([
            'user_id' => $this->user->id,
            'quiz_snapshot_id' => $this->snapshot->id,
        ]);

        $this->redirectRoute('quiz.attempt', $attempt);

    }

    public function render(): View
    {
        return view('livewire.quizzes.preface');
    }
}
