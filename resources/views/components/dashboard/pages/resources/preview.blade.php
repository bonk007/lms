<x-dashboard.layout>
    <x-slot:title>{{ __('Preview: :title', ['title' => $resource->getAttribute('title')]) }}</x-slot:title>
    <div class="h-full mx-20 py-8">
        <livewire:dashboard.resources.preview :resource="$resource" />
    </div>
</x-dashboard.layout>
