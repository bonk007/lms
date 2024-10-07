<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use App\Models\Sessions\CourseSession;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Show extends Component
{

    public Course $course;

    public ?CourseSession $session = null;

    public string $activeTab = '#courses';

    public function boot(): void
    {
        $this->initSession();
    }

    protected function initSession(): void
    {
        $user = auth()->user();
        $isCreator = $this->course->getAttribute('created_by') === $user->getKey();

        if ($isCreator || $this->session?->getKey() !== null) {
            return;
        }

        $this->session = CourseSession::query()->firstOrCreate([
            'course_id' => $this->course->getKey(),
            'user_id' => $user->getKey(),
            'last_activity_at' => now()
        ]);
    }

    public function switchTab(string $switchTo): void
    {
        $this->activeTab = $switchTo;
    }

    public function render(): View
    {
        return view('livewire.courses.show');
    }
}
