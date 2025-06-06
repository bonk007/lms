<?php

namespace App\Livewire;

use App\Models\Agenda;
use App\Models\Course;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Calendar extends Component
{
    public string $title = "Calendar";

    public int $selectedMonth;

    public int $selectedYear;

    public ?Course $course = null;

    public User $user;

    public array $currentMonthAttributes = [
        'startDayInWeek' => 0,
        'endDayInWeek' => 0,
        'endDate' => null,
    ];

    public function mount(): void
    {
        $this->selectedMonth = now()->month;
        $this->selectedYear = now()->year;
        $this->changeMonth();
    }

    public function changeMonth(): void
    {
        $date = Carbon::create($this->selectedYear, $this->selectedMonth);
        $this->currentMonthAttributes = [
            'startDayInWeek' => $date?->startOfMonth()->dayOfWeek,
            'startDayName' => $date?->startOfMonth()->dayName,
            'endDayInWeek' => $date?->endOfMonth()->dayOfWeek,
            'endDate' => $date?->endOfDay()->day,
            'endDayName' => $date?->endOfDay()->dayName,

        ];
    }

    protected function agendas(): Collection
    {
        $date = Carbon::create($this->selectedYear, $this->selectedMonth) ?? now();
        $startMonth = $date->startOfMonth()->toImmutable();
        $endMonth = $date->endOfMonth();

        return Agenda::query()
            ->whereBelongsTo($this->user, 'user')
            ->whereBetween('going_at', [$startMonth, $endMonth])
            ->when($this->course !== null, function ($query) {
                return $query->whereBelongsTo($this->course, 'course');
            })->get();
    }

    public function render(): View
    {
        return view('livewire.calendar', ['agendas' => $this->agendas()]);
    }
}
