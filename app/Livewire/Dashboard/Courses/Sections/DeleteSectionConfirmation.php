<?php

namespace App\Livewire\Dashboard\Courses\Sections;

use App\Livewire\Dashboard\Courses\TopicItem;
use App\Livewire\Traits\HasAlert;
use App\Models\Section;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class DeleteSectionConfirmation extends ModalComponent
{
    use HasAlert;

    public Section $section;

    public function delete(): void
    {
        $this->section->loadMissing(['topic']);
        /** @var \App\Models\Topic $topic */
        $topic = $this->section->topic;

        if ($topic->published) {
            $this->error(__("Can not delete section from published topic"));
            return;
        }

        $this->section->delete();
        $this->confirmed();
    }

    protected function confirmed(): void
    {
        $this->dispatch('reload')->to(TopicItem::class);
        $this->closeModal();
    }

    public function render(): View
    {
        return view('livewire.dashboard.courses.sections.delete-section-confirmation');
    }
}
