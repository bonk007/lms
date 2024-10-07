<?php

namespace App\Livewire\Dashboard\Resources\Modal;

use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class DeleteConfirmation extends ModalComponent
{
    /**
     * @var string Can be `delete`, `restore`, or `flush`
     */
    public string $kind = 'delete';

    public function render(): View
    {
        return view('livewire.dashboard.resources.modal.delete-confirmation');
    }
}
