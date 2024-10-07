<div class="flex justify-center items-center h-full">
    <div class="w-1/4 py-4 border bg-white dark:bg-slate-700">
        <div class="flex flex-col px-6">
            <span class="text-xl font-semibold">{{ $data['title'] }}</span>
            <span class="text-xs font-semibold">{{ $data['subtitle'] }}</span>
        </div>
        <div class="flex items-center justify-center gap-4 px-6">
            <x-buttons.link href="#">{{ __("Cancel") }}</x-buttons.link>
            <x-buttons.link href="#" kind="primary" wire:click.prevent="confirm">{{ __("Continue") }}</x-buttons.link>
        </div>
    </div>
</div>
