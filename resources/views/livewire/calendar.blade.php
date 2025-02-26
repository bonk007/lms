<div x-data="{
    selectedMonth: $wire.entangle('selectedMonth', true),
    selectedYear: $wire.entangle('selectedYear', true),
    months: [@js(__('January')),@js(__('February')),@js(__('March')),@js(__('April')),@js(__('May')),@js(__('June')),@js(__('July')),@js(__('August')),@js(__('September')),@js(__('October')),@js(__('November')),@js(__('December'))],
    changeMonth(direction) {
        let month = this.selectedMonth + direction
        if (month <= 0) {
            this.selectedMonth = 12
            this.selectedYear -= 1
            $wire.changeMonth()
            return
        }

        if (month > 12) {
            this.selectedMonth = 1
            this.selectedYear += 1
            $wire.changeMonth()
            return
        }

        this.selectedMonth = month
        $wire.changeMonth()
    },
    changeYear(direction) {
        this.selectedYear += direction
        $wire.changeMonth()
    },
    month() {
        const index = this.selectedMonth - 1
        return this.months[index]
    }
}">
    <div class="flex items-center justify-between">
        <div class="text-xl">{{ $title }}</div>
        <div class="flex items-center gap-2.5">

            <div class="flex items-center gap-1 min-w-52">
                <a href="" x-on:click.prevent="changeMonth(-1)"> {{-- Previous --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                    </svg>
                </a>
                <div class="px-8 py-3 flex-grow text-center" x-text="month()"></div>
                <a href="" x-on:click.prevent="changeMonth(1)"> {{-- Next --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                    </svg>
                </a>
            </div>

            <div class="flex items-center gap-1  min-w-52">
                <a href="" x-on:click.prevent="changeYear(-1)"> {{-- Previous --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                    </svg>
                </a>
                <div class="px-8 py-3 flex-grow text-center" x-text="selectedYear"></div>
                <a href="" x-on:click.prevent="changeYear(1)"> {{-- Next --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
    <div class="grid grid-cols-7 gap-1.5">
        @foreach([__("Sunday"), __("Monday"), __("Tuesday"), __("Wednesday"), __("Thursday"), __("Friday"), __("Saturday")] as $dayNumber => $dayName)
            <div class="border rounded py-4 text-center {{ $dayNumber === 0 ? 'text-red-600' : null }}">{{ $dayName }}</div>
        @endforeach
        @php
            $day = 0;
            $cols = 35;
            $items = 0;
            $now = now();
        @endphp
        @for($idx = 0; $idx < $cols; $idx++)
            @php

                if ($idx >= $this->currentMonthAttributes['startDayInWeek']) {
                    ++$day;
                }

                if ($idx >= $cols -1 && $day < $this->currentMonthAttributes['endDate']) {
                    $cols += 7;
                }

                $dateObject = \Illuminate\Support\Carbon::create($this->selectedYear, $this->selectedMonth, $day);

                if (is_int($now)) {
                    dd($now);
                }
                $isToday = $now->isSameDay($dateObject);

                $items = $agendas->where(function ($agenda) use($dateObject) {
                    return $agenda->getAttribute('going_at')->isSameDay($dateObject);
                })->count();

            @endphp
            @if($day > 0 && $day <= $this->currentMonthAttributes['endDate'])
                <x-chunks.calendar-tile
                    x-on:click.prevent="$dispatch('openModal', {component: 'modal.calendar-detail', arguments: {course: {{ $course?->id ?? 'null' }}, selected: '{{ $dateObject }}'}})"
                    :date="$dateObject"
                    :holiday="($idx === 0) || ($idx % 7 === 0)">
                @if($items > 0)
                    <div class="flex gap-2">
                        @for($i = 0; $i < $items; $i++)
                            <div class="h-2 w-2 rounded-full bg-red-500"></div>
                        @endfor
                    </div>
                @endif
                </x-chunks.calendar-tile>
            @else
                <div class="border rounded py-4 px-4 bg-slate-300"></div>
            @endif
        @endfor
    </div>
</div>
