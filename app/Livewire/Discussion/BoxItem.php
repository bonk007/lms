<?php

namespace App\Livewire\Discussion;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class BoxItem extends Component
{
    public bool $read = false;

    public function render(): View
    {
        return view('livewire.discussion.box-item');
    }

    public function select(): void
    {

    }

    public function like(): void
    {

    }
}
