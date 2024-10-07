<?php

namespace App\Livewire\Dashboard\Courses\Sections;

use App\Models\Topic;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class ContentOptions extends ModalComponent
{
    public Topic $topic;

    public function render(): View
    {
        return view('livewire.dashboard.courses.sections.content-options');
    }
}
