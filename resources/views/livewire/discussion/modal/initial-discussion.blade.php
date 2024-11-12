<div class="px-6 py-4 flex flex-col gap-4">
    <h1 class="mb-3 text-xl font-bold">{{ __("New Discussion") }}</h1>
    <x-forms.inputs.text
        name="title"
        id="title"
        wire:model="title"
        placeholder="{{ __('Title') }}"
        label="Title"
        required />

    <x-forms.inputs.wysiwyg
        label="Content"
        name="content"
        id="content"
        wire:model="content"
{{--        placeholder="{{ __('Course\'s short description') }}"--}}
        required>{{ $content }}</x-forms.inputs.wysiwyg>

    <div class="flex justify-end items-center gap-4">
        <a href="#" wire:click.prevent="$dispatch('closeModal')">{{ __('Cancel') }}</a>
        <button class="bg-slate-950 dark:bg-green-600 dark:hover:bg-green-400 hover:bg-red-500 text-slate-50 px-8 py-3 rounded" @click.prevent="$wire.post()">{{__('Save')}}</button>
    </div>

</div>
