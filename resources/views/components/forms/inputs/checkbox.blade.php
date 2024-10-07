<x-forms.inputs.container {{ $attributes->only(['id', 'name', 'label', 'label-position', 'required', 'info']) }}>
    <input type="checkbox" {{ $attributes->except(['type', 'label', 'label-position', 'class']) }} />
</x-forms.inputs.container>
