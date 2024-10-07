<x-dashboard.layout>
    <x-slot:title>{{ $course->getAttribute('name') }}</x-slot:title>
    <div class="h-full mx-20 py-8">
        <livewire:dashboard.courses.detail :$course />
    </div>
</x-dashboard.layout>
