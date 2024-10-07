@php

    $defaultClasses = ['flex', 'px-4', 'py-2', 'justify-center', 'items-center', 'gap-2', 'rounded', 'cursor-pointer'];
    $currentClasses = match($attributes->get('kind', 'default')) {
        'primary' => ['bg-slate-950', 'text-slate-50', 'dark:bg-green-600', 'dark:hover:bg-green-400'],
        'secondary' => ['bg-red-500', 'text-slate-50'],
        'danger' => ['text-slate-50', 'bg-red-600', 'hover:bg-red-500'],
        default => ['bg-slate-300', 'border', 'dark:text-slate-950']
    };

@endphp

<button {{ $attributes->except(['kind'])->class([...$defaultClasses, ...$currentClasses]) }}>
    {{ $slot }}
</button>
