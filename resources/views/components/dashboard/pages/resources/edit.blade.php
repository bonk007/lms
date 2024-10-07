<x-dashboard.layout>
    <x-slot:title>{{ __('Edit: :title ', ['title' => $resource->getAttribute('title')]) }}</x-slot:title>
    <div class="h-full mx-20 py-8">
        <livewire:dashboard.resources.form
            :resource="$resource"
            :page-title="__('Edit: :title ', ['title' => $resource->getAttribute('title')])" />
    </div>
</x-dashboard.layout>
