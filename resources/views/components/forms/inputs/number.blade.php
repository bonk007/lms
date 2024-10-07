<x-forms.inputs.container {{ $attributes->only(['id', 'name', 'label', 'label-position', 'required', 'info']) }}>
    <input type="number" {{ $attributes->class(['bg-slate-50 text-slate-950 dark:text-slate-100 dark:bg-opacity-5 border border-slate-300 dark:border-slate-600'])->except(['type', 'label']) }} />
</x-forms.inputs.container>
