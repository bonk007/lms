<x-dashboard.layout>
    <x-slot:title>{{ __('Edit Quiz: :title', $quiz->only(['title'])) }}</x-slot:title>
    <div class="h-full mx-20 py-8">
        <livewire:dashboard.quizzes.form-panel :title="__('Edit Quiz: :title', $quiz->only(['title']))" :quiz="$quiz" />
    </div>
</x-dashboard.layout>
