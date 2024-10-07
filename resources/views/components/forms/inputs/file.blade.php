<x-forms.inputs.container {{ $attributes->only(['id', 'name', 'label', 'label-position', 'required', 'info']) }}>
    <input type="file" {{ $attributes->except(['label', 'label-position', 'required', 'info']) }} />
</x-forms.inputs.container>
