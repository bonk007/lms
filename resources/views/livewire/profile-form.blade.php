<div>
    <x-forms.inputs.text name="name" id="name" label="Name" required wire:model.live="name" />
    <x-buttons.button wire:click.prevent="save">
        {{ __("Save") }}
    </x-buttons.button>
</div>
