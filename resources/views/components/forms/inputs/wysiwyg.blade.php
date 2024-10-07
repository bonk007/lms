<x-forms.inputs.container {{ $attributes->only(['id', 'name', 'label', 'label-position', 'required', 'info']) }}>
    <div wire:ignore x-data="{
        model: $wire.entangle('{{ $attributes->get('wire:model', 'text') }}'),
        editor: null,
        initCkEditor() {
            if (this.editor) {
                return
            }
            ckeditor($refs.editor, ($editor) => {
                $editor.model.document.on('change:data', () => this.model = $editor.getData())
                $editor.setData(this.model)
                this.editor = $editor
            })
        }
    }" x-init="initCkEditor()">

        <div x-ref="editor">{{ $slot }}</div>
        <textarea {{ $attributes->only(['id', 'name', 'required', 'wire:model']) }}
          style="display: none" x-text="model"></textarea>
    </div>
</x-forms.inputs.container>
