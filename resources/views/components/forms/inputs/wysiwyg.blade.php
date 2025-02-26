<x-forms.inputs.container {{ $attributes->only(['id', 'name', 'label', 'label-position', 'required', 'info']) }}>
    <div wire:ignore x-data="{
        model: $wire.entangle('{{ $attributes->get('wire:model', 'text') }}'),
        editor: null,
        classicEditor: null,
        async initCkEditor() {
            if (this.editor) {
                return
            }
            this.classicEditor = await ckeditor($refs.editor, ($editor) => {
                $editor.model.document.on('change:data', () => this.model = $editor.getData())
                $editor.setData(this.model)
                this.editor = $editor
            })
        },
        clear() {
            console.log($refs.editor)
        }
    }" x-init="initCkEditor()" x-on:clear-editor.window="clear()">

        <div x-ref="editor" x-text="model"></div>
        <textarea {{ $attributes->only(['id', 'name', 'required', 'wire:model']) }}
          style="display: none" x-text="model"></textarea>
    </div>
</x-forms.inputs.container>
