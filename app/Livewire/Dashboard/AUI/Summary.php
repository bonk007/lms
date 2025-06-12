<?php

namespace App\Livewire\Dashboard\AUI;

use App\Livewire\Dashboard\AUI\Concerns\WithDistribution;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Summary extends Component
{
    use WithDistribution;

    public Collection $data;

    public function mount(): void
    {
        $course = Course::query()
            ->withCount('enrollments')
            ->whereBelongsTo(auth()->user(), 'creator')
            ->orderBy('id')
            ->first();

        $this->data = $this->getData($course);
    }

    public function render(): View
    {
        return view('livewire.dashboard.aui.summary');
    }
}
