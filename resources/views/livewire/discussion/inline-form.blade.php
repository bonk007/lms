<div x-data="{
    htmlMessage: $wire.entangle('message'),
    initEditor() {
        ckeditor($refs.editor, function ($editor) {
            this.htmlMessage = $editor.editor.getData()
            $wire.message = $editor.editor.getData()
        })
    }
}" class="bg-slate-50 dark:bg-slate-950/75">
    @if(!empty($quoted))
    <div class="p-2">
        <div class="border rounded relative px-4 py-2">
            <a href="#" class="absolute right-2 top-2" wire:click.prevent="removeQuoted">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </a>
            <div class="text-xs">
                <div class="flex gap-2 items-center">
                    <div class="h-8 w-8 border rounded-full font-semibold flex justify-center items-center">{{ $quoted['author']['initial'] }}</div>
                    <div class="font-bold">{{ $quoted['author']['fullname'] }}</div>
                </div>
                <div class="max-h-10 overflow-hidden text-nowrap text-ellipsis">
                    {!! $quoted['message'] !!}
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="flex items-center gap-1 pb-2" x-init="initEditor()">
        <a href="#" class="p-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
            </svg>
        </a>
        <div class="flex-1">
            <x-forms.inputs.wysiwyg
{{--                label="{{ __('Description') }}"--}}
                name="message"
                id="post-message"
                wire:model="message" />
        </div>
        <a href="#" class="p-4" wire:click.prevent="post">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
            </svg>
        </a>
    </div>
</div>
