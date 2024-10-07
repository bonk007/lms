<div class="flex flex-col gap-4">
    <div class="py-4">
        <span class="text-xl">{{ $pageTitle }}</span>
    </div>
    <x-forms.inputs.text id="title" name="title" label="{{ __('Label') }}" wire:model="title"/>
    <x-forms.inputs.wysiwyg id="abstract" name="abstract" label="{{ __('Abstract') }}" wire:model="abstract"/>
    {{--    <x-forms.inputs.radio id="html" name="is-html" value="true" label="HTML" label-position="right" wire:model="isHTML" />--}}
    {{--    <x-forms.inputs.radio id="non-html" name="is-html" value="false" label="File" label-position="right" wire:model="isHTML" />--}}

    <div x-data="{
        shouldBeHtml: $wire.entangle('isHTML'),
        toggle() {
            this.shouldBeHtml = !this.shouldBeHtml
            $wire.set('isHTML', this.shouldBeHtml)
        }
    }">

        <span class="text-sm font-semibold">{{ __('Use HTML') }}</span>
        <a href="#" class="block w-16 shadow inset-1 rounded-full" @click.prevent="toggle()">
            <span class="w-8 h-8 block rounded-full shadow" :class="!shouldBeHtml ? 'bg-slate-500 switch-off' : 'bg-red-500 switch-on'"></span>
        </a>
    </div>

    @if($isHTML)
        <x-forms.inputs.wysiwyg id="content" name="content" label="{{ __('HTML Content') }}" wire:model="content"/>
    @else
        <x-forms.inputs.file wire:model="file" name="file" id="file" />
    @endif

    <div class="flex items-center justify-end gap-4">
        <x-buttons.link class="min-w-36">{{ __('Cancel') }}</x-buttons.link>
        <x-buttons.button class="min-w-36" kind="primary"
            wire:click.prevent="submit">Save</x-buttons.button>
    </div>

</div>
