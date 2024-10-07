<x-dashboard.layout>
    <x-slot:title>{{ __('Create new Resource') }}</x-slot:title>
    <div class="h-full mx-20 py-8">
        <livewire:dashboard.resources.form :page-title="__('Create new Resource')" />
    </div>
</x-dashboard.layout>
