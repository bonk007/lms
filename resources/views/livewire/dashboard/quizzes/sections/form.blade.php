<div class="flex flex-col gap-4 mx-8 my-4">
    <x-forms.inputs.text required wire:model="title" id="title" name="title" label="Title" />
    <x-forms.inputs.text wire:model="subtitle" id="subtitle" name="subtitle" label="Subtitle" />
    <x-forms.inputs.checkbox wire:model="randomQuestions" name="randomized" id="randomized" label="Random Questions Order" />
    <x-forms.inputs.wysiwyg wire:model="description" name="description" id="description" label="Description" />
    <div class="flex justify-end items-center gap-2">
        <x-buttons.link href="#" wire:click.prevent="closeForm">Back</x-buttons.link>
        <x-buttons.button kind="primary" wire:click.prevent="submit">
            <span>{{ __("Save") }}</span>
        </x-buttons.button>
    </div>
</div>
