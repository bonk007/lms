<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Card extends Component
{

    public Course $course;

    public ?User $user = null;

    public bool $showEnrollButton = true;

    protected $listeners = [
        'enrolled'
    ];

    public function enroll(): void
    {
        if (null === $this->user) {
            $this->redirectRoute('login');
            return;
        }

        $this->enrolling();

    }

    protected function enrolling(): void
    {
        DB::transaction(function () {
            $this->course->enrollments()
                ->create([
                    'user_id' => $this->user->getKey(),
                    'status' => Enrollment::STATUS_APPROVED,
                    'type' => Enrollment::TYPE_SELF
                ]);

            $this->course->startSession($this->user);
        });

        $this->dispatch('enrolled');
    }

    public function enrolled(): void
    {
        $this->redirectRoute('courses.show', ['course' => $this->course]);
    }

    public function render(): View
    {
        return view('livewire.courses.card');
    }
}
