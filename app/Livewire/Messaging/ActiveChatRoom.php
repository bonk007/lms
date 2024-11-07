<?php

namespace App\Livewire\Messaging;

use App\Events\GotNewMessage;
use App\Models\Attachment;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ActiveChatRoom extends Component
{
    use WithFileUploads, WithPagination;

    /**
     * @var \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
     */
    public $upload;

    public ?string $content = null;

    public ?Attachment $attachment = null;

    public ?Conversation $conversation = null;

    public ?Message $reply = null;

    public User $user;

    public User $sendTo;

    public function mount(): void
    {
        $this->conversation->loadMissing([
//            'messages' => fn (HasMany $query) => $query->with('replied'),
            'participants' => function (BelongsToMany $query) {
                return $query->where('user_id', '!=', $this->user->id);
            }
        ]);
    }

    public function query(): Builder
    {
        return Message::query()
            ->whereBelongsTo($this->conversation, 'conversation');
    }

    public function send(): void
    {
        $this->validate([
            'upload' => ['sometimes', 'nullable', 'file', 'mimes:jpeg,jpg,png,gif'],
            'content' => ['required_if:upload,null']
        ]);

        DB::transaction(function () {

            if (null === $this->conversation) {
                $this->initiate();
            }

            if (null !== $this->upload) {
                $this->createAttachment();
            }

            $message = $this->conversation->messages()->create([
                'sent_by' => $this->user->id,
                'content' => $this->content,
            ]);

            $message->conversation()->associate($this->conversation);

            if (null === $this->reply) {
                $message->replied()->associate($this->reply);
            }

            $message->save();

            broadcast(new GotNewMessage($message))->toOthers();

        });

        $this->reset('upload', 'content', 'reply', 'attachment');

    }

    public function setReply(Message $message): void
    {
        $this->reply = $message;
    }

    public function render(): View
    {
        return view('livewire.messaging.active-chat-room', [
            'messages' => $this->query()->paginate(30)
        ]);
    }

    private function initiate(): void
    {
        $conversation = Conversation::query()->create([]);
        $conversation->participants()->attach([$this->user->id => ['is_initiator' => true]]);
        $this->conversation = $conversation;

        $this->dispatch( event: 'selectConversation', params: ['conversation' => $conversation] )
            ->to(Panel::class);
    }

    private function createAttachment(): Attachment
    {
        $filename = 'attachment-' .now()->format('Y-m-d_H-i-s').'.'.$this->upload->extension();
        $newPath = $this->upload->storeAs('conversations/'.$this->conversation->getKey(), $filename);
        return $this->attachment = Attachment::create([
            'user_id' => $this->user->id,
            'size' => $this->upload->getSize(),
            'mime' => $this->upload->getMimeType(),
            'path' => $newPath,
        ]);

    }
}
