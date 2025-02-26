<?php

namespace App\Livewire\Courses;

use App\Livewire\Traits\HasAlert;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Sessions\CourseSession;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Show extends Component
{
    use HasAlert;

    public Course $course;

    public ?CourseSession $session = null;

    public string $activeTab = '#courses';

    public function boot(): void
    {
        $this->initSession();
    }

    public function render(): View
    {
        return view('livewire.courses.show');
    }

    public function enroll(): void
    {
        $this->session = DB::transaction(function (): CourseSession {
            $this->course->enrollments()
                ->create([
                    'user_id' => auth()->id(),
                    'status' => Enrollment::STATUS_APPROVED,
                    'type' => Enrollment::TYPE_SELF
                ]);

            return $this->course->startSession(auth()->user());
        });

        $this->success('You have enrolled this course');
    }

    public function switchTab(string $switchTo): void
    {
        if ($switchTo !== '#courses' && !$this->isAuthorized()) {
            $this->error(__('You do not have permission to view this course.'));
            $this->activeTab = '#courses';
            return;
        }

        $this->activeTab = $switchTo;
    }

    public function isAuthorized(): bool
    {
        return Gate::forUser(auth()->user())->allows('view', $this->course);
    }

    protected function initSession(): void
    {
        $user = auth()->user();
        $isCreator = $this->course->getAttribute('created_by') === $user->getKey();

        if ($isCreator || !$this->isAuthorized() || $this->session?->getKey() !== null) {
            return;
        }

        $this->session = CourseSession::query()->firstOrCreate([
            'course_id' => $this->course->getKey(),
            'user_id' => $user->getKey(),
            'last_activity_at' => now()
        ]);
    }
}
