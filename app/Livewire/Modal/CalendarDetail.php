<?php

namespace App\Livewire\Modal;

use App\Models\Agenda;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use LivewireUI\Modal\ModalComponent;

class CalendarDetail extends ModalComponent
{
    public ?Course $course = null;

    public string $selected;

    public function mount()
    {
        dd(func_get_args());
    }

    protected function agendas(): Collection
    {
        return Agenda::query()
            ->whereDate('going_at', $this->selected)
            ->whereBelongsTo(auth()->user(), 'user')
            ->when($this->course !== null, function ($query) {
                return $query->whereBelongsTo($this->course, 'course');
            })->get();
    }

    public function render(): View
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->selected);
        return view('livewire.modal.calendar-detail', [
            'agendas' => $this->agendas(),
            'date' => $date,
        ]);
    }
}
