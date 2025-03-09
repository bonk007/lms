<?php

namespace App\Livewire\Dashboard\Courses\Sections;

use App\Livewire\Dashboard\Courses\TopicItem;
use App\Models\Section;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class DeleteSectionConfirmation extends ModalComponent
{
    public ?Section $section = null;

    public function mount(Section $section): void
    {
        $this->section = $section;
    }

    public function confirmed(): void
    {
        $this->closeModal();
        $this->dispatch('deleteSectionConfirmed', $this->section)->to(TopicItem::class);
    }

    public function render(): View
    {
        return view('livewire.dashboard.courses.sections.delete-section-confirmation');
    }
}
