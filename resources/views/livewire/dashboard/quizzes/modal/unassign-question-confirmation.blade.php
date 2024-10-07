<div>
    <div class="px-4 py-3 text-xl">{{ __("Confirmation") }}</div>
    <div class="px-4 py-3">
        {{ __("Are you sure you want to unassigned this question on the section?") }}
    </div>
    <div class="px-4 py-3 flex justify-end items-center gap-4">
        <x-buttons.link href="#" wire:click.prevent="closeModal">
            <span>{{ __("Cancel") }}</span>
        </x-buttons.link>
        <x-buttons.link href="#" kind="primary" wire:click.prevent="confirm">
            <span>{{ __("Confirmed") }}</span>
        </x-buttons.link>
    </div>
</div>
