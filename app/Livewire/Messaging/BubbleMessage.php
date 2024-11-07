<?php

namespace App\Livewire\Messaging;

use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class BubbleMessage extends Component
{
    public Message $message;

    public User $user;

    public bool $isOwned = false;

    public function boot(): void
    {
        $this->isOwned = $this->message->getAttribute('sent_by') === $this->user->getKey();
    }

    public function read(): void
    {
        // do nothing for read message or owned message
        if ($this->message->getAttribute('is_read') || $this->message->getAttribute('sent_by') === $this->user->getKey()) {
            return;
        }

        $this->message->setAttribute('read_at', now())
            ->save();
    }

    public function render(): View
    {
        return view('livewire.messaging.bubble-message');
    }
}
