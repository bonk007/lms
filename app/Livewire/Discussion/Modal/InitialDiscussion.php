<?php

namespace App\Livewire\Discussion\Modal;

use App\Livewire\Discussion\Container;
use App\Livewire\Discussion\Panel;
use App\Models\Course;
use App\Models\Discussion;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class InitialDiscussion extends ModalComponent
{
    public ?Course $course = null;

    public string $title = '';

    public string $content = '';

    public function post(): void
    {
        $this->validate(['title' => 'required', 'content' => 'required']);

        $discussion = DB::transaction(function () {
            $discussion = Discussion::query()->create([
                'title' => $this->title,
//                'content' => $this->content,
                'course_id' => $this->course?->id,
                'created_by' => auth()->id(),
            ]);

            $initialPost = $discussion->posts()->create([
                'content' => $this->content,
                'user_id' => auth()->id(),
            ]);

            $discussion->initialPost()->associate($initialPost)->save();

            return $discussion;
        });

        $this->dispatch('setDiscussion', $discussion->getKey())->to(Panel::class);
        $this->dispatch('reload')->to(Container::class);

        $this->closeModal();

    }

    public function render(): View
    {
        return view('livewire.discussion.modal.initial-discussion');
    }
}
