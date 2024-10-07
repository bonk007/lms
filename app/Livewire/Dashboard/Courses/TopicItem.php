<?php

namespace App\Livewire\Dashboard\Courses;

use App\Models\Topic;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TopicItem extends Component
{
    public Topic $topic;

    protected $listeners = [
        'reload'
    ];

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
