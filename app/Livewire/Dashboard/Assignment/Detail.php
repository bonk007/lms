<?php

namespace App\Livewire\Dashboard\Assignment;

use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Detail extends Component
{
    public Assignment $assignment;

    public Course $course;

    public array $tabs = [
        'info' => "Detail",
        'attempts' => "Attempts",
    ];

    public string $tab = 'info';

    public function switchTab(string $tab): void
    {
        if (!isset($this->tabs[$tab])) {
            return;
        }

        $this->tab = $tab;
    }

    public function render(): View
    {
        return view('livewire.dashboard.assignment.detail');
    }
}
