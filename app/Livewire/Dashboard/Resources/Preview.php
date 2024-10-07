<?php

namespace App\Livewire\Dashboard\Resources;

use App\Models\Resource;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Preview extends Component
{

    public Resource $resource;

    public function render(): View
    {
        return view('livewire.dashboard.resources.preview');
    }
}
