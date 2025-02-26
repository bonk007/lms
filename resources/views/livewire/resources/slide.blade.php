<div class="relative">
    <div class="absolute px-6 py-4 bg-black/30 text-slate-300 bottom-4 right-2 z-50">Press esc to close the slides</div>
    <div class="flex justify-center items-center gap-4">
        <a href="#" class="p-8 bg-white/10 hover:bg-white/30 rounded-full" wire:click.prevent="prev">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
        </a>
        <div class="flex-1 max-w-[calc(100% - 4rem)]">
            <img src="{{ $slideItem->img }}" />
        </div>
        <a href="#" class="p-8 bg-white/10 hover:bg-white/30 rounded-full" wire:click.prevent="next">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </a>
    </div>
</div>

