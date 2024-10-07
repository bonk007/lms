<?php

namespace App\Livewire\Dashboard\Resources;

use App\Models\Resource;
use Livewire\Component;

class StackItem extends Component
{
    public Resource $resource;

    public function render()
    {
        return view('livewire.dashboard.resources.stack-item');
    }
}
