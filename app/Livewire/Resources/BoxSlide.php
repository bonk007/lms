<?php

namespace App\Livewire\Resources;

use App\Models\Resource;
use Illuminate\Contracts\View\View;
class BoxSlide extends Slide
{
    public Resource $resource;

    public function render(): View
    {
        return view('livewire.resources.box-slide');
    }
}
