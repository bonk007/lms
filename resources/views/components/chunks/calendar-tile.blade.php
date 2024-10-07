@props([
    'holiday' => false,
    'date' => null,
])
<div {{ $attributes->class([
    'border',
    'rounded',
    'py-4',
    'px-4',
    'text-xs',
    'font-semibold',
    'bg-slate-300' => !($date instanceof \Illuminate\Support\Carbon),
    'hover:bg-blue-100 hover:text-blue-900' => $date instanceof \Illuminate\Support\Carbon,
    'text-red-600' => $holiday,
    'bg-blue-500 text-slate-50' => now()->isSameDay($date)
]) }}>
    {{ $date instanceof \Illuminate\Support\Carbon ? $date->day : null }}
</div>
