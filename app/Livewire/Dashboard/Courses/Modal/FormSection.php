<?php

namespace App\Livewire\Dashboard\Courses\Modal;

use App\Models\Section;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class FormSection extends ModalComponent
{
    public ?Section $section = null;

    public function render(): View
    {
        return view('livewire.dashboard.courses.modal.form-section');
    }
}
