<?php

namespace App\Livewire\Messaging;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Panel extends Component
{
    public bool $open = false;
    public bool $startNew = false;

    public User $user;

    public ?Conversation $selectedConversation = null;

    protected $listeners = [
        'selectConversation',
        'startConversation',
        'deselect'
    ];

    public function selectConversation(Conversation $conversation): void
    {
        $this->openChatRoom();
        $this->selectedConversation = $conversation;
    }

    public function deselect(): void
    {
        $this->reset('open', 'startNew', 'selectedConversation');
    }

    public function startConversation(): void
    {
        $this->startNew = true;
    }

    public function openChatRoom(): void
    {
        $this->open = true;
    }

    public function closeChatRoom(): void
    {
        $this->open = false;
    }

    public function render(): View
    {
        return view('livewire.messaging.panel');
    }
}
