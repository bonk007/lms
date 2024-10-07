<x-dashboard.layout>
    <x-slot:title>{{ __('Create new Quiz') }}</x-slot:title>
    <div class="h-full mx-20 py-8">
        <livewire:dashboard.quizzes.form-panel :title="__('Create new Quiz')" />
    </div>
</x-dashboard.layout>
