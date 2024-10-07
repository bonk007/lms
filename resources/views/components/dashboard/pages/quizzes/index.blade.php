<x-dashboard.layout>
    <x-slot:title>{{ __('Manage Quizzes') }}</x-slot:title>
    <div class="h-full mx-20 py-8">
        <livewire:dashboard.quizzes.stack :title="__('Manage Quizzes')" />
    </div>
</x-dashboard.layout>
