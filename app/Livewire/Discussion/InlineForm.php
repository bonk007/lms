<?php

namespace App\Livewire\Discussion;

use App\Models\Course;
use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class InlineForm extends Component
{
    use WithFileUploads;

    /**
     * Message's body
     *
     * @var string
     */
    public string $message = '';

    /**
     * Quoted message or replied message
     *
     * @var array|null
     */
    public ?array $quoted;

    /**
     * Discussion post attachment
     *
     * @var ?\Illuminate\Http\UploadedFile
     */
    public $attachment;

    public ?Course $course = null;

    public ?Discussion $discussion = null;


    public function removeQuoted(): void
    {
        $this->quoted = null;
    }

    public function post(): void
    {
        if ($this->discussion === null) {
            return;
        }

        $this->discussion->posts()->create([
            'content' => $this->message,
            'user_id' => auth()->id(),
        ]);

//        $this->reset('message', 'quoted', 'attachment');
        $this->message = '';
        $this->dispatch('reload')->to(Container::class);
        $this->dispatch('clear-editor');
    }

    public function render(): View
    {
        return view('livewire.discussion.inline-form');
    }
}
