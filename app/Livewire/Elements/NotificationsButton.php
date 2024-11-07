<?php

namespace App\Livewire\Elements;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class NotificationsButton extends Component
{
    public User $user;

    public int $unreadCount = 0;

    protected $listeners = [
        'updated'
    ];

    public function mount(): void
    {
        $this->count();
    }

    public function updated(): void
    {
        $this->count();
    }

    protected function count(): void
    {
        $this->unreadCount = $this->user->unreadNotifications->count();
    }

    public function render(): View
    {
        return view('livewire.elements.notifications-button');
    }
}
