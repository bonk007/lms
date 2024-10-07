<x-dashboard.layout>
    <x-slot:title>{{ __('Manage Courses') }}</x-slot:title>
    <div class="mx-20 py-8">
        <div>
            {{ __('Manage Courses') }}
        </div>
        <livewire:dashboard.courses.stack />
    </div>
</x-dashboard.layout>
