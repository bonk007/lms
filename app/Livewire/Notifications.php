<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;

class Notifications extends Component
{
    public int $start = 0;

    public int $loaded = 10;

    public array $selected = [];

    public User $user;

    public array $notifications;

    public function boot(): void
    {
        $this->notifications = $this->notifications()->get()
            ->map(fn(DatabaseNotification $notification) => [
                ...$notification->toArray(),
                ...[
                   'created_at' => $notification->getAttribute('created_at')->diffForHumans(now()),
                ]
            ])
            ->toArray();
    }

    protected function notifications()
    {
        return $this->user->notifications()
            ->orderBy('created_at', 'desc')
            ->offset($this->start)
            ->limit($this->loaded);
    }

    public function read(DatabaseNotification $notification): void
    {
        if ($notification->unread()) {
            $notification->markAsRead();
        }

        /** @var array $data */
        $data = $notification->getAttribute('data');
        $this->redirect($data['url']);

    }

    public function markAsRead(): void
    {
        $this->user->notifications()
            ->whereIn('id', $this->selected)
            ->update(['read_at' => now()]);
    }

    public function markAsUnread(): void
    {
        $this->user->notifications()
            ->whereIn('id', $this->selected)
            ->update(['read_at' => null]);
    }

    public function loadMore(): void
    {
        $this->loaded += 10;

        if ($this->loaded > 30) {
            $this->start = $this->loaded - 10;
        }

    }

    public function loadPrevious(): void
    {
        if ($this->start === 0) {
            return;
        }

        $this->loaded -= 10;
        $this->start = $this->loaded - 10;
    }

    public function render(): View
    {
        return view('livewire.notifications');
    }
}
