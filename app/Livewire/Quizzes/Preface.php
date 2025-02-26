<?php

namespace App\Livewire\Quizzes;

use App\Livewire\Traits\HasAlert;
use App\Models\QuizAttempt;
use App\Models\Snapshots\QuizSnapshot;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Preface extends Component
{
    use HasAlert;

    public User $user;

    public QuizSnapshot $snapshot;

    public ?QuizAttempt $attempt = null;

    public array $data;

    public function mount(): void
    {
        $this->user = auth()->user();
        $this->data = $this->snapshot->getAttribute('quiz_data');
        $this->checkingAttempt();
    }

    protected function checkingAttempt(): void
    {
        $this->attempt = QuizAttempt::query()
            ->whereBelongsTo($this->user, 'user')
            ->whereBelongsTo($this->snapshot, 'snapshot')
            ->first();

    }

    public function confirm(): void
    {
        if ($this->attempt !== null) {
            $this->error("You already attempted this quiz. Please wait until scoring is done");
            return;
        }
        
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
