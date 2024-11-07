<?php

namespace App\Livewire\Messaging;

use App\Models\Conversation;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Livewire\Component;

class ConversationList extends Component
{
    public ?Conversation $selectedConversation = null;

    public function render(): View
    {
        return view('livewire.messaging.conversation-list', [
            'conversations' => $this->query()->paginate()
        ]);
    }

    public function select(Conversation $conversation): void
    {
        $this->selectedConversation = $conversation;
        $this->dispatch(event: 'selectConversation', conversation: $conversation)
            ->to(Panel::class);
    }

    public function deselect(): void
    {
        $this->selectedConversation = null;
        $this->dispatch(event: 'deselect')
            ->to(Panel::class);
    }

    private function query(): Builder
    {
        return Conversation::query()
            ->with([
                'participants' => fn (BelongsToMany $query) => $query->where('user_id', '!=', auth()->id())
            ])
            ->whereHas('participants', function (Builder $query) {
                return $query->where('user_id', auth()->id());
            })->orderByDesc(Model::UPDATED_AT);
    }
}
