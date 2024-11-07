<?php

namespace App\Livewire\Discussion;

use App\Models\Course;
use App\Models\Discussion;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Panel extends Component
{
    use WithPagination;

    public bool $createPost = false;

    public ?Course $course = null;

    public ?Discussion $activeDiscussion = null;

    protected $listeners = [
        'setDiscussion'
    ];

    public function initDiscussion(): void
    {
        $this->createPost = true;
    }

    public function closeContainer(): void
    {
        $this->createPost = false;
    }

    public function setDiscussion(Discussion $discussion): void
    {
        $this->activeDiscussion = $discussion;
        $this->dispatch('setDiscussion', $discussion)->to(Container::class);
    }

    public function discussions(): LengthAwarePaginator
    {
        return Discussion::query()
            ->whereBelongsTo($this->course, 'course')
            ->orderByDesc('updated_at')
            ->paginate();
    }

    public function render(): View
    {
        return view('livewire.discussion.panel', [
            'discussions' => $this->discussions(),
        ]);
    }
}
