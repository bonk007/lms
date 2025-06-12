<?php

namespace App\Livewire\Dashboard\AUI;

use App\Models\Course;
use App\Models\Sessions\CourseSession;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TopUsersDistribution extends Component
{
    public Collection $sessions;

    public function mount(): void
    {
        $course = Course::query()
            ->withCount('enrollments')
            ->whereBelongsTo(auth()->user(), 'creator')
            ->orderBy('id')
            ->first();

        $this->sessions = CourseSession::query()
            ->with(['user'])
            ->distinct('user_id', 'course_id')
            ->whereBelongsTo($course, 'course')
            ->take(5)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.dashboard.aui.top-users-distribution');
    }
}
