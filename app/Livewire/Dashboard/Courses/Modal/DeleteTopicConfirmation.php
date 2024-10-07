<?php

namespace App\Livewire\Dashboard\Courses\Modal;

use App\Livewire\Dashboard\Courses\TopicItem;
use App\Livewire\Traits\HasAlert;
use App\Models\Topic;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class DeleteTopicConfirmation extends ModalComponent
{
    use HasAlert;

    public Topic $topic;

    public function delete(): void
    {
        if ($this->topic->published) {
            $this->error(__("Can not delete published topic"));
            $this->closeModal();
            return;
        }

        $this->topic->delete();
        $this->closeModal();
        $this->dispatch('reload')->to(TopicItem::class);
    }

    public function render(): View
    {
        return view('livewire.dashboard.courses.modal.delete-topic-confirmation');
    }
}
