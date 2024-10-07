<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Modal extends Component
{
    public bool $show = false;

    public function render(): View
    {
        return view('livewire.modal');
    }
}
