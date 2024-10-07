<?php

namespace App\Livewire\Discussion;

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


    public function removeQuoted(): void
    {
        $this->quoted = null;
    }

    public function render(): View
    {
        return view('livewire.discussion.inline-form');
    }
}
