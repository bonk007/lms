<x-dashboard.layout>
    <x-slot:title>{{ __('Create Course') }}</x-slot:title>
    <div class="h-full mx-20 py-8">
        <div>
            {{ __('Create Course') }}
        </div>
        <livewire:dashboard.courses.form />
    </div>
</x-dashboard.layout>
