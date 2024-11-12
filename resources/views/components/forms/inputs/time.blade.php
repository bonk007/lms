<x-forms.inputs.container {{ $attributes->only(['id', 'name', 'label', 'label-position', 'required', 'info']) }}>
    <input type="time" {{ $attributes->except(['type', 'label', 'label-position']) }} class="bg-slate-50 text-slate-950 dark:text-slate-100 dark:bg-opacity-5 border border-slate-300 dark:border-slate-600">
</x-forms.inputs.container>
