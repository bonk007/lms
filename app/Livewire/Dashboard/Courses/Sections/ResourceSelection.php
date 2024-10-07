<?php

namespace App\Livewire\Dashboard\Courses\Sections;

use App\Livewire\Dashboard\Courses\TopicItem;
use App\Models\Resource;
use App\Models\Section;
use App\Models\Topic;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class ResourceSelection extends ModalComponent
{
    public Topic $topic;

    public ?Resource $resource = null;

    public ?Section $section = null;

    public function mount(): void
    {
        $this->initResource();
    }

    protected function initResource(): void
    {
        $content = $this->section?->loadMissing(['content'])->content;
        if (!$content instanceof Resource) {
            return;
        }
        $this->resource = $content;
    }

    public function select(Resource $resource): void
    {
        $this->resource = $resource;
    }

    public function submit(): void
    {
        if ($this->section?->getKey() === null) {
            $this->create();
            return;
        }

        $this->update();
    }

    protected function create(): void
    {
        $section = new Section(['visible' => true]);
        $section->topic()->associate($this->topic);
        $section->content()->associate($this->resource)->save();

        $this->section = $section;

        $this->saved();
    }

    protected function update(): void
    {
        $this->section->content()
            ->associate($this->resource)->save();
        $this->saved();
    }

    protected function saved(): void
    {
        $this->closeModal();
        $this->dispatch('closeModal')->to(ContentOptions::class);
        $this->dispatch('reload')->to(TopicItem::class);
    }

    public function render(): View
    {
        return view('livewire.dashboard.courses.sections.resource-selection');
    }
}
