<?php

namespace App\Livewire\Discussion;

use App\Models\Course;
use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Container extends Component
{
    use WithPagination;

    public ?Course $course = null;

    public Discussion $discussion;

    protected $listeners = [
        'setDiscussion',
        'reload'
    ];

    public function reload(): void
    {
        $this->discussion->refresh();
    }

    public function setDiscussion(Discussion $discussion): void
    {
        $this->discussion = $discussion;
    }

    protected function getPosts(): Builder
    {
        return Post::query()
            ->whereBelongsTo($this->discussion, 'discussion')
            ->orderByDesc('created_at');
    }

    public function render(): View
    {
        return view('livewire.discussion.container', [
            'posts' => $this->getPosts()->paginate()
        ]);
    }
}
