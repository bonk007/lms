<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Calendar extends Component
{
    public string $title = "Calendar";

    public int $selectedMonth;

    public int $selectedYear;

    public array $currentMonthAttributes = [
        'startDayInWeek' => 0,
        'endDayInWeek' => 0,
        'endDate' => null,
    ];

    public function boot(): void
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

    public function render(): View
    {
        return view('livewire.calendar');
    }
}
