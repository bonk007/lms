<div x-data="{
    resourceSelected($event) {
        const [param] = $event.detail
        $wire.select(param.resource)
    }
}" class="max-w-screen m-12">

    <div class="flex flex-col">
        <div class="px-4 py-3 text-xl" x-on:resource-selected.window="resourceSelected($event)">
            {{ __("Select Resource") }}
        </div>

        <div class="max-h-[600px] overflow-x-hidden overflow-y-auto">
            <livewire:dashboard.resources.stack :has-selection="true" :selected-resource="$resource?->getKey()" />
        </div>

        <div>
            <div class="flex justify-end items-center gap-4">
                <x-buttons.link href="#" wire:click.prevent="closeModal">
                    <span>{{ __("Cancel") }}</span>
                </x-buttons.link>
                <x-buttons.link href="#" kind="primary" wire:click.prevent="submit">
                    <span>{{ __("Save") }}</span>
                </x-buttons.link>
            </div>
        </div>


    </div>


</div>
