<x-dashboard.layout>
    <x-slot:title>{{ __('Edit Topic :topic', ['topic' => $topic->getAttribute('title')]) }}</x-slot:title>
    <div class="px-20 py-8">
        <livewire:dashboard.courses.topic-form :course="$course" :topic="$topic" />
    </div>
</x-dashboard.layout>
