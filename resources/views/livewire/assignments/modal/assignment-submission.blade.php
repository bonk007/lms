<div>
    <div class="px-8 py-2 text-xl font-semibold">{{ $assignment->title }}</div>
    <div class="flex flex-col gap-4 px-8 py-4">
        <x-forms.inputs.wysiwyg name="response" id="response" wire:model="response" label="Response" />
        <x-forms.inputs.dropzone name="upload" id="upload" wire:model="upload" label="Upload File" />
    </div>
    <div class="flex gap-4 justify-end items-center">
        <a href="#" wire:click.prevent="$dispatch('closeModal')">{{ __('Cancel') }}</a>
        <button class="bg-slate-950 dark:bg-green-600 dark:hover:bg-green-400 hover:bg-red-500 text-slate-50 px-8 py-3 rounded" @click.prevent="$wire.attempt()">{{__('Save')}}</button>
    </div>
</div>
