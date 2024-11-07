<?php

namespace App\Livewire\Discussion;

use App\Models\Discussion;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class BoxItem extends Component
{
    public bool $read = false;

    public Discussion $discussion;

    public function boot(): void
    {
        $this->discussion
            ->loadCount(['posts'])
            ->loadMissing(['creator']);

    }

    public function render(): View
    {
        return view('livewire.discussion.box-item');
    }

    public function select(): void
    {
        $this->dispatch('setDiscussion', $this->discussion)->to(Panel::class);
    }

    public function like(): void
    {

    }
}
