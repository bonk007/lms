@props([
    'rules' => [],
    'multiple' => false
])

<x-forms.inputs.container {{ $attributes->only(['id', 'name', 'label', 'label-position', 'required', 'info']) }}>
    <livewire:dropzone
        {{ $attributes->except(['label', 'label-position', 'required', 'info']) }}
        :rules="$rules"
        :multiple="$multiple" />
</x-forms.inputs.container>
