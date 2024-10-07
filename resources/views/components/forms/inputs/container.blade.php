<div>
    <div {{ $attributes->only('class')->class([
        'flex text-slate-950 dark:text-slate-100',
        'flex-col gap-1' => !$attributes->has('label-position') || $attributes->get('label-position') === 'top',
        'gap-4 items-center' => $attributes->has('label-position') && $attributes->get('label-position') !== 'top',
    ]) }}>
        @if(!$attributes->has('label-position') || in_array($attributes->get('label-position'), ['top', 'left']))
            <label {{ $attributes->only('class')->class([
                    'font-semibold text-sm',
                    'flex-grow' => $attributes->get('label-position') !== 'top'
                ]) }}
                   for="{{ $attributes->get('id') ?? $attributes->get('name') }}">
                {{ $attributes->get('label') }}
            @if($attributes->has('required'))
                <span class="text-red-600">*</span>
            @endif

            @if($attributes->has('info'))
                <span class="block text-xs text-slate-300 dark:text-slate-600">{{ $attributes->get('info') }}</span>
            @endif
            </label>
        @endif

        {{ $slot }}

        @if($attributes->has('label-position') && $attributes->get('label-position') === 'right')
            <label class="font-semibold text-sm"
                   for="{{ $attributes->get('id') ?? $attributes->get('name') }}">
                {{ __($attributes->get('label')) }}
            @if($attributes->has('required'))
                <span class="text-red-600">*</span>
            @endif

            @if($attributes->has('info'))
                <span class="block text-xs text-slate-300 dark:text-slate-600">{{ $attributes->get('info') }}</span>
            @endif
            </label>
        @endif

    </div>
    @error($attributes->get('name'))
    <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
