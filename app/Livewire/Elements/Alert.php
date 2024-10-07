<?php

namespace App\Livewire\Elements;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Alert extends Component
{
    public string $severity = 'success';

    public string $message = '';

    public bool $show = false;

    protected $listeners = [
        'hide' => 'dispose',
        'show' => 'show',
    ];

    public function show(string $message, string $severity): void
    {
        $this->severity = $severity;
        $this->message = $message;
        $this->show = true;

        $this->dispatch('showing');
    }

    public function dispose(): void
    {
        $this->message = '';
        $this->show = false;
    }

    public function render(): View
    {
        return view('livewire.elements.alert');
    }
}
