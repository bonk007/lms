<x-forms.inputs.container {{ $attributes->only(['id', 'name', 'label', 'label-position', 'required', 'info']) }}>
    <select {{ $attributes->except(['label', 'label-position', 'info']) }}>
        {{ $slot }}
    </select>
</x-forms.inputs.container>
