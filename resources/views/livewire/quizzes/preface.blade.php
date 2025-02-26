<div class="flex justify-center items-center h-full">
    <div class="w-1/4 py-4 border bg-white dark:bg-slate-700">
        <div class="flex flex-col px-6">
            <span class="text-xl font-semibold">{{ $data['title'] }}</span>
            <span class="text-xs font-semibold">{{ $data['subtitle'] }}</span>
            <div class="mt-8 flex flex-col gap-4">
                @if ($attempt !== null)
                    <div class="flex gap-2">
                        <div>Scoring Status: </div>
                        <div class="font-bold">{{ $attempt->getAttribute('scoring_status_text') }}</div>
                    </div>
                    <div class="flex gap-2">
                        <div>Score: </div>
                        <div class="text-2xl font-bold">{{ $attempt->getAttribute('scores') }}</div>
                    </div>
                @endif
            </div>

        </div>
        <div class="flex items-center justify-center gap-4 px-6">
            @if($attempt === null)
            <x-buttons.link href="#">{{ __("Cancel") }}</x-buttons.link>
            <x-buttons.link href="#" kind="primary" wire:click.prevent="confirm">{{ __("Continue") }}</x-buttons.link>
            @endif
        </div>
    </div>
</div>
