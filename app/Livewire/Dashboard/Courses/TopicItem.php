<?php

namespace App\Livewire\Dashboard\Courses;

use App\Livewire\Traits\HasAlert;
use App\Models\Section;
use App\Models\Topic;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TopicItem extends Component
{
    use HasAlert;

    public Topic $topic;

    protected $listeners = [
        'reload',
        'deleteSectionConfirmed'
    ];

    public function deleteSectionConfirmed(Section $section): void
    {
        $section->loadMissing(['topic']);
        /** @var \App\Models\Topic $topic */
        $topic = $section->topic;

        if ($topic->published) {
            $this->error(__("Can not delete section from published topic"));
            return;
        }

        $section->delete();

        $this->success("Section has been deleted");
        $this->reload();
    }

    public function boot(): void
    {
        $this->topic->loadMissing([
            'sections.content'
        ]);
    }

    public function publish(): void
    {
        DB::transaction(function () {
            $this->topic->update(['published_at' => now()]);
            $this->topic->dependencyTopic()->update(['published_at' => now()]);
        });

    }

    public function draft(): void
    {
        DB::transaction(function () {
            $this->topic->update(['published_at' => null]);
            $this->topic->relies()->update(['published_at' => null]);
        });
    }

    public function reload(): void
    {
        $this->topic->refresh();
    }

    public function render(): View
    {
        return view('livewire.dashboard.courses.topic-item');
    }
}
