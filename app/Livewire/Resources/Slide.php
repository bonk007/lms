<?php

namespace App\Livewire\Resources;

use App\Models\SlideItem;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Slide as Model;
use LivewireUI\Modal\ModalComponent;

class Slide extends ModalComponent
{
    public Model $slide;
    public ?SlideItem $slideItem = null;

    public ?Collection $items = null;

    public int $currentIdx = 0;

    public function boot(): void
    {
        $this->slide->loadMissing(['items']);
        $this->items = $this->slide->items;
        $this->slideItem = $this->items->get($this->currentIdx);
    }

    public function next(): void
    {
        $this->currentIdx++;
        if ($this->items->has($this->currentIdx)) {

            return;
        }

        $this->currentIdx = 0;
    }

    public function prev(): void
    {
        $this->currentIdx--;
        if ($this->items->has($this->currentIdx)) {
            return;
        }

        $this->currentIdx = 0;
    }

    public function render(): View
    {
        return view('livewire.resources.slide');
    }
}
