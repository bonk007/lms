<?php

namespace App\Livewire\Dashboard\Courses\Sections;

use App\Models\Quiz;
use App\Models\Resource;
use App\Models\Section;
use App\Models\Snapshots\QuizSnapshot;
use App\Models\Topic;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class Form extends ModalComponent
{
    public Topic $topic;

    public ?Section $section = null;

    public null|Resource|Quiz $content = null;

    protected function initContent(): void
    {
        $this->section?->loadMissing(['content']);
        $content =  $this->section?->content;

        if ($content instanceof QuizSnapshot) {
            $content->loadMissing(['quiz']);
            $this->content = $content->quiz;
            return;
        }

        $this->content = $content;
    }

    public function mount(): void
    {
        $this->initContent();
    }

    public function render(): View
    {
        return view('livewire.dashboard.courses.sections.form');
    }
}
