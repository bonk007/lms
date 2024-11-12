<x-dashboard.layout>
    <x-slot:title>{{ __("Assignment") }}</x-slot:title>
    <div class="h-full mx-20 py-8">
        <livewire:dashboard.assignment.detail :$course :$assignment />
    </div>
</x-dashboard.layout>
