<x-layouts.no-header>
    <x-slot:title>{{ $quizData['title'] }}</x-slot:title>
    <livewire:quizzes.attempt :attempt="$attempt" />
</x-layouts.no-header>
