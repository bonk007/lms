<?php

namespace App\Livewire\Courses\Topics;

use App\Livewire\Traits\HasAlert;
use App\Models\Course;
use App\Models\Sessions\CourseSession;
use App\Models\Sessions\TopicSession;
use App\Models\Topic;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Stack extends Component
{
    use HasAlert;

    public Course $course;

    public ?CourseSession $courseSession = null;


    public Collection $topics;

    public function boot(): void
    {
        $this->course->loadMissing(['topics']);
        $this->topics = $this->course->getAttribute('topics');
    }

    public function startSession(Topic $topic): void
    {
        if (Gate::forUser(auth()->user())->denies('view', $this->course)) {
            $this->error("You should enroll the course before you access the topic.");
        }

        if ($this->courseSession?->getKey() === null) {
            return;
        }

        $this->courseSession->update([
            'last_activity_at' => now()
        ]);

        TopicSession::query()
            ->firstOrCreate([
                'course_session_id' => $this->courseSession->getKey(),
                'topic_id' => $topic->getKey()
            ]);

        $this->redirectRoute('courses.topics.show', [
            'course' => $this->course,
            'topic' => $topic
        ]);

    }

    public function render(): View
    {
        return view('livewire.courses.topics.stack');
    }
}
