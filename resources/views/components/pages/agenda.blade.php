<x-layouts.blank>
    <x-slot:title>Agenda</x-slot:title>
    <div>
        <livewire:calendar :user="auth()->user()" />
    </div>
</x-layouts.blank>
