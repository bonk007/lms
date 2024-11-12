<?php

namespace App\Livewire\Dashboard\Assignment;

use App\Models\Assignment;
use App\Models\AssignmentAttempt;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Attempt extends Component
{
    public Assignment $assignment;

    public AssignmentAttempt $attempt;

    public function render(): View
    {
        return view('livewire.dashboard.assignment.attempt');
    }
}
