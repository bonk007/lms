<div x-data="{
    resourceSelected($event) {
        const [param] = $event.detail
        $wire.select(param.resource)
    }
}" class="max-h-full max-w-full my-4 mx-8">
    <div class="px-4 py-3 text-xl" x-on:resource-selected.window="resourceSelected($event)">
        {{ __("Select Resource") }}
    </div>

    <livewire:dashboard.resources.stack :has-selection="true" :selected-resource="$resource?->getKey()" />

    <div class="flex justify-end items-center gap-4">
        <x-buttons.link href="#" wire:click.prevent="closeModal">
            <span>{{ __("Cancel") }}</span>
        </x-buttons.link>
        <x-buttons.link href="#" kind="primary" wire:click.prevent="submit">
            <span>{{ __("Save") }}</span>
        </x-buttons.link>
    </div>
</div>
