<x-dashboard.layout>
    <x-slot:title>{{ __('Create Topic') }}</x-slot:title>
    <div class="px-20 py-8">
        <livewire:dashboard.courses.topic-form :course="$course" />
    </div>
</x-dashboard.layout>
