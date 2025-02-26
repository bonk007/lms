<x-dashboard.layout>
    <x-slot:title>{{ __('Edit Course') }}</x-slot:title>
    <div class="h-full mx-20 py-8">
        <div>
            {{ __('Edit Course') }}
        </div>
        <livewire:dashboard.courses.form :course="$course" />
    </div>
</x-dashboard.layout>
