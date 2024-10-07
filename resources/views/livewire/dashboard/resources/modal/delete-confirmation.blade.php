<div>
    <h1 class="text-xl font-semibold">{{ __("Confirmation") }}</h1>
    <div>
        {{ match($kind) {
    'restore' => __("Are you sure you want to restore this resource?"),
    'flush' => __("Are you sure you want to flush this resource? It means this resource will be gone completely"),
    default => __("Are you sure you want to delete this resource? It will be marked as trashed"),
} }}
        <div class="flex justify-between items-center">
            <x-buttons.link wire:click.prevent="$dispatch('closeModal')">{{ __("Cancel") }}</x-buttons.link>
            <x-buttons.link kind="danger" wire:click.prevent="$dispatch('closeModal')">{{ __("Confirmed") }}</x-buttons.link>
        </div>
    </div>
</div>
